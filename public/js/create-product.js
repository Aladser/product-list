const formClass = 'form-new-product';

/** Клиентский табличный контроллер */
const tableController = new ProductClientController(
    "/product",
    null,
    document.querySelector("#table-error"),
    document.querySelector(`.${formClass}`)
);