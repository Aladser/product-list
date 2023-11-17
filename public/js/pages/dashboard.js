/** Клиентский табличный контроллер
 * @param {*} URL серверного контроллера
 * @param {*} table  таблица
 * @param {*} msgElement инфоэлемент
 */
const tableController = new ProductClientController(
    "/product",
    document.querySelector("#table-product tbody"),
    document.querySelector("#table-error")
);

//ссылка страницы редактирования товара
const editBtn = document.querySelector("#btn-edit");
// ссылка страницы товара
const showBtn = document.querySelector("#btn-info");
//кнопка удаления товара
const removeBtn = document.querySelector("#btn-remove");

//клик строки
let rows = document.querySelectorAll(".table-product__tr");
rows.forEach((row) => {
    row.onclick = clickRow;
});
function clickRow(e) {
    let row = e.target.closest("tr");

    if (!row.classList.contains("table-product__tr--active")) {
        // убирание текущей активной строки
        let activeRow = document.querySelector(".table-product__tr--active");
        if (activeRow) {
            activeRow.classList.remove("table-product__tr--active");
            activeRow.classList.add("bg-white");
        }

        // показ активной строки
        row.classList.add("table-product__tr--active");
        row.classList.remove("bg-white");
        // показ кнопок
        editBtn.classList.remove("hidden");
        removeBtn.classList.remove("hidden");
        showBtn.classList.remove("hidden");
        // id активной строки
        let id = row.id.slice(row.id.indexOf("-") + 1);
        // обновление ссылок кнопок
        showBtn.href = `/product/${id}`;
        editBtn.href = `/product/${id}/edit`;
        removeBtn.onclick = () => {
            tableController.remove(row);
            hideButtons();
        };
    } else {
        // скрытие кнопок
        row.classList.remove("table-product__tr--active");
        row.classList.add("bg-white");
        editBtn.classList.add("hidden");
        removeBtn.classList.add("hidden");
        showBtn.classList.add("hidden");
        hideButtons();
    }
}

// скрыть кнопки
function hideButtons() {
    editBtn.classList.add("hidden");
    removeBtn.classList.add("hidden");
    showBtn.classList.add("hidden");
}
