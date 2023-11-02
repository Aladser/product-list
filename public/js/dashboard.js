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