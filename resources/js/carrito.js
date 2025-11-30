/* ============================================================
   SISTEMA DE CARRITO AJAX — CINERAMA
   ============================================================ */

function loadCart() {
    fetch("/carrito", {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("carrito-items").innerHTML = data.html;
        document.getElementById("carrito-total").innerText = "S/ " + data.total.toFixed(2);
    });
}

function addToCart(name, price, image = null, qty = 1) {
    fetch("/carrito/agregar", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            name: name,
            price: price,
            image: image,
            qty: qty
        })
    })
    .then(res => res.json())
    .then(data => {
        loadCart();
    });
}

function updateQty(key, qty) {
    if (qty < 1) return;

    fetch("/carrito/update", {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ key: key, qty: qty })
    })
    .then(res => res.json())
    .then(data => {
        loadCart();
    });
}

function removeItem(key) {
    fetch("/carrito/remove", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ key: key })
    })
    .then(res => res.json())
    .then(data => {
        loadCart();
    });
}

window.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("carrito-items")) {
        loadCart();
    }
});
