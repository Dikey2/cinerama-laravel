// ===============================
// 🎟️ GUARDAR ENTRADAS EN LARAVEL
// ===============================

window.guardarEntradas = async function(entradas, seats, showtime_id, cine_id) {

    try {
        let response = await fetch("/guardar-entradas", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                entradas,
                seats,
                showtime_id,
                cine_id
            })
        });

        let data = await response.json();

        console.log("RESPUESTA DEL BACKEND:", data);

        // 👇 AQUI ESTABA EL ERROR
        if (!data.success) {
            alert("Error guardando entradas");
            return false;
        }

        // ⭐ Agregar entradas al carrito
        await fetch('/carrito/agregar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                tipo: "entradas",
                entradas: entradas
            })
        });

        // ⭐ Redirigir a la dulcería correspondiente
        window.location.href = "/dulceria/" + data.cinema_id;

        return true;

    } catch (e) {
        console.error("❌ ERROR JS:", e);
        return false;
    }
}
