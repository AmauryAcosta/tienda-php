const apiUrl = "http://localhost/tienda-php/src/index.php";
const productForm = document.getElementById("productForm");
const alertContainer = document.getElementById("alertContainer");
const productTableBody = document.getElementById("productTableBody");
const btnSubmit = document.getElementById("submitBtn");

document.addEventListener("DOMContentLoaded", () => {
  loadProductos();
});

const borrarProducto = async (id) => {
  try {
    const send = {
      id: id,
    };
    const res = await fetch(apiUrl + "/productos", {
      method: "DELETE",
      body: JSON.stringify(send),
    });
    const borrado = await res.json();
    console.log("@@@ res => ", borrado);
  } catch (error) {
    console.error("Error: ", error);
  }
};

const loadProductos = async () => {
  try {
    const res = await fetch(apiUrl + "/productos", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const productos = await res.json();
    productTableBody.innerHTML = "";
    productos.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.idproducto}</td>
        <td>${item.nombre}</td>
        <td>${item.descripcion}</td>
        <td>${item.tipo}</td>
        <td>${item.precio}</td>
        <td>
          <button class="btn btn-warning btn-sm" data_id="${item.idproducto}">Editar</button>
          <button class="btn btn-danger btn-sm" data_id="${item.idproducto}">Borrar</button>
        </td>
      `;
      productTableBody.appendChild(row);
    });
  } catch (error) {
    console.error("Error:", error);
  }
};

productTableBody.addEventListener("click", (e) => {
  if (e.target.classList.contains("btn-danger")) {
    borrarProducto(e.target.getAttribute("data_id"));
  }
});

const crearProducto = async () => {
  const productId = document.getElementById("productId").value;
  const producto = {
    nombre: document.getElementById("nombre").value,
    descripcion: document.getElementById("descripcion").value,
    tipo: document.getElementById("tipo").value,
    precio: document.getElementById("precio").value,
    imagen: document.getElementById("imagen").value,
  };
  const url = productId
    ? `${apiUrl}/productos/id=${productId}`
    : `${apiUrl}/productos`;
  const method = productId ? "PUT" : "POST";

  console.log("@@@ ruta y metodo => ", url, method);
  const resultado = await fetch(url, {
    method: method,
    body: JSON.stringify(producto),
  });

  const response = await resultado.json();
  if (response.mensaje === "Producto Creado") {
    showAlert("Producto Agregado", "success");
    loadProductos();
    productForm.reset();
  } else {
    showAlert("Error al agregar el producto", "danger");
  }
  document.getElementById("productId").value = "";

  console.log("@@@ response => ", response);
};

btnSubmit.addEventListener("click", (event) => {
  event.preventDefault();
  crearProducto();
});

btnSubmit.addEventListener("submit", (event) => {
  event.preventDefault();
  crearProducto();
});

const showAlert = (mensaje, tipo) => {
  alertContainer.innerHTML = `
    <div class="alert alert-${tipo} alert-dismissable fade show" role="alert">
      ${mensaje}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
      </button>
    </div>
  `;
  setTimeout(() => {
    alertContainer.innerHTML = "";
  }, 3000);
};
