document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".menu-btn");
    const hasilResep = document.getElementById("hasil-resep");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            const category = this.getAttribute("data-category");

            // Ambil data dari resep.php menggunakan AJAX
            fetch(`resep.php?query=${category}`)
                .then(response => response.json())
                .then(data => {
                    hasilResep.innerHTML = ""; // Kosongkan hasil sebelumnya

                    if (data.results.length > 0) {
                        data.results.forEach(resep => {
                            const resepHTML = `
                                <div class="resep">
                                    <h3>${resep.title}</h3>
                                    <img src="${resep.image}" alt="${resep.title}">
                                    <br>
                                    <a href="https://spoonacular.com/recipes/${encodeURIComponent(resep.title)}-${resep.id}" target="_blank">Lihat Resep</a>
                                </div>
                            `;
                            hasilResep.innerHTML += resepHTML;
                        });
                    } else {
                        hasilResep.innerHTML = "<p>Tidak ada resep ditemukan.</p>";
                    }
                })
                .catch(error => console.error("Gagal mengambil data:", error));
        });
    });
});
