const formClass = 'form-edit-product';

/** Клиентский табличный контроллер
 * @param {*} URL серверного контроллера
 * @param {*} msgElement инфоэлемент
 * @param {*} form форма добавления
 */
const tableController = new ProductClientController(
    "/product/update",
    null,
    document.querySelector("#table-error"),
    document.querySelector(".form-edit-product"),
    formClass
);