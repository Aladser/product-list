const role = document.querySelector('meta[name="role"]').content;

/** Клиентский табличный контроллер
 * @param {*} URL серверного контроллера
 * @param {*} msgElement инфоэлемент
 * @param {*} form форма добавления
 */
const tableController = new ProductClientController(
    "/product",
    null,
    document.querySelector("#table-error"),
    document.querySelector(".form-new-product")
);