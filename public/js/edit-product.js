const formClass = 'form-edit-product';

const tableController = new ProductClientController(
    "/product",
    null,
    document.querySelector("#table-error"),
    null,
    document.querySelector(`.${formClass}`)
);