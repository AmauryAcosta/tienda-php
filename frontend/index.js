const apiUrl = "http://localhost/tienda-php/src/routes/routes.php";
const productForm = document.getElementById("productForm");
const alertContainer = document.getElementById("alertContainer");
const productTableBody = document.getElementById("productTableBody");

document.addEventListener("DOMContentLoaded", () => {
  loadProductos();
});

const loadProductos = async () => {
  const getProducts = apiUrl + "/productos";
  const res = await fetch(getProducts);
  const productos = await res.json();
  console.log("Productos => ", productos);
};
