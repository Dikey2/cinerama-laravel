import Alpine from "alpinejs";

window.peliculasApp = function(data) {

    data = data.map(p => ({
        ...p,
        showtimes: p.showtimes ?? []
    }));

    return {
        tab: 'cartelera',
        modalAbierto: false,
        peliculaSeleccionada: { showtimes: [] },
        filtro: { ciudad: '', genero: '' },

        peliculas: data,

        get generosUnicos() {
            const generos = this.peliculas.map(p => p.genre);
            return [...new Set(generos.filter(Boolean))];
        },

        get peliculasFiltradas() {
            return this.peliculas.filter(p => 
                (!this.filtro.genero || p.genre === this.filtro.genero) &&
                (!this.filtro.ciudad || p.city === this.filtro.ciudad)
            );
        },

        abrirModal(pelicula) {
            this.peliculaSeleccionada = {
                ...pelicula,
                showtimes: pelicula.showtimes ?? []
            };
            this.modalAbierto = true;
        },

        agruparPorCine(showtimes) {
            const grupos = {};
            showtimes.forEach(s => {
                const cine = s.cinema_name ?? "Sin cine";
                if (!grupos[cine]) grupos[cine] = [];
                grupos[cine].push(s);
            });
            return grupos;
        },

        agruparPorFormatoIdioma(showtimes) {
            const grupos = {};
            showtimes.forEach(s => {
                const key = `${s.format} - ${s.language}`;
                if (!grupos[key]) grupos[key] = [];
                grupos[key].push(s);
            });
            return grupos;
        }
    };
};

Alpine.start();
