const formClass = 'form-edit-product';

/** Клиентский табличный контроллер */
const tableController = new ProductClientController(
    "/product",
    null,
    document.querySelector("#table-error"),
    null,
    document.querySelector(`.${formClass}`)
);