/** Клиентский табличный контроллер
 * @param {*} URL серверного контроллера
 * @param {*} table  таблица
 * @param {*} msgElement инфоэлемент
 */
const tableController = new ProductClientController(
    "/product",
    document.querySelector("#table-product tbody"),
    document.querySelector("#table-error"),
);


let rows = document.querySelectorAll('.table-product__tr');
rows.forEach(row => {row.onclick = clickRow});
const editBtn = document.querySelector('#btn-edit');
const removeBtn = document.querySelector('#btn-remove');
const showBtn = document.querySelector('#btn-info');

function clickRow(e) {
    let row = e.target.closest('tr');

    if (row.classList.contains('bg-white')) {
        // убирание другой активной строки
        let activeRow = document.querySelector('.table-product__tr--active');
        if (activeRow) {
            activeRow.classList.remove('table-product__tr--active');
            activeRow.classList.add('bg-white');
        }

        row.classList.add('table-product__tr--active');
        row.classList.remove('bg-white');
        editBtn.classList.remove('hidden');
        removeBtn.classList.remove('hidden');
        showBtn.classList.remove('hidden');
    } else {
        row.classList.remove('table-product__tr--active');
        row.classList.add('bg-white');
        editBtn.classList.add('hidden');
        removeBtn.classList.add('hidden');
        showBtn.classList.add('hidden');
    }
}