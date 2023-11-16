const formClass = 'form-edit-product';
const tableError = document.querySelector("#table-error");
const form = document.querySelector(".form-edit-product");
const csrfToken = document.querySelector('meta[name="csrf-token"]');
let headers = {
    "X-CSRF-TOKEN": csrfToken.getAttribute("content"),
};

form.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log(e.target);

    // запрос на сервер
    ServerRequest.execute(
        'product',
        (data) => console.log(data),
        "put",
        tableError,
        form,
        headers
    );
});