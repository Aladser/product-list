const formClass = 'form-edit-product';
const tableError = document.querySelector("#table-error");
const form = document.querySelector(".form-edit-product");
const csrfToken = document.querySelector('meta[name="csrf-token"]');
let headers = {
    "X-CSRF-TOKEN": csrfToken.getAttribute("content"),
    'Content-Type': 'application/json'
};
const id = form.getAttribute('data-id');
let data = {};

// артикул
if (form.articul) {
    data.articul = form.articul
} else {
    data.articul = document.querySelector('#form-edit-product').textContent;
}
// имя
data.name = form.name.value;
// статус
data.status = form.status.value;
// атрибуты
let attrMap = new Map();
let attributesElements = document.querySelectorAll(
    ".form-edit-product__attribute"
);
if (attributesElements.length > 0) {
    attributesElements.forEach((element) => {
        let name = element.querySelector(
            ".form-edit-product__attr-name"
        ).value;
        let value = element.querySelector(
            ".form-edit-product__attr-value"
        ).value;
        if (name !== "" && value !== "") {
            attrMap.set(name, value);
        }
    });
}
attr = JSON.stringify(Object.fromEntries(attrMap));
data.attr = attr;

let response = await fetch('/product', {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
        "X-CSRF-TOKEN": csrfToken.getAttribute("content"),
    },
    body: JSON.stringify(data)
}).then(r => r.text()).then(data => {
    console.log(data);
});