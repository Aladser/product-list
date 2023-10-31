const form = document.querySelector('.form-new-product');

form.onsubmit = (event) => {
    event.preventDefault();
    let formData = new FormData(event.srcElement);

    let process = (data) => {
        console.clear();
        console.log(data);
    };

    // запрос на сервер
    ServerRequest.execute(
        '/product',
        process,
        "post",
        this.msgElement,
        formData,
    );
}