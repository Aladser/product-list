const form = document.querySelector(".form-new-product");
const table = document.querySelector("#table-product tbody");
const errorPrg = document.querySelector("#table-error");
const backBtn = document.querySelector('.form-new-product_btn-back');
const addBtn = document.querySelector('.form-new-product_btn-submit');
// роль
const role = document.querySelector('meta[name="role"]').content;
// поле формы артикула
const articul = document.querySelector('#form-new-product__articul');

// кнопка отмены редактирования
backBtn.onclick = clearForm;
// очистка формы
function clearForm() {
    form.reset();
    backBtn.classList.add('hidden');
    form.setAttribute("data-type", 'add');
    addBtn.value = 'Добавить';
    errorPrg.textContent = '';
}

/** Клиентский табличный контроллер
 * @param {*} URL URL бэк-контроллера
 * @param {*} table  таблица тем
 * @param {*} msgElement инфоэлемент
 * @param {*} form форма добавления элемента
 */
const tableController = new ProductClientController(
    "/product",
    table,
    errorPrg,
    form
);