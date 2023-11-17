const formClass = 'form-edit-product';

/** Клиентский табличный контроллер */
const tableController = new ProductClientController(
    "/product",
    null,
    document.querySelector("#table-error"),
    null,
    document.querySelector(`.${formClass}`)
);

// кнопка добавить аттрибут
const addAttrBtn = document.querySelector(`.${formClass}__add-attr`);
// кнопка секции атрибутов
const attributesSection = document.querySelector(`.${formClass}__attributes`);
// Атрибуты товара
const productAttributes = new ProductAttribute(formClass, addAttrBtn, attributesSection);