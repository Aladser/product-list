/** Фронт-контроллер таблицы */
class ProductClientController extends ClientController {
    // добавить запись в БД
    add(form, event) {
        event.preventDefault();

        // действия после успешного добавления данных в БД
        let process = (data) => {
            console.log(data);
            this.msgElement.textContent = data.result == 1 ? 'товар добавлен' : data.description;
        };

        // данные формы
        let formData = new FormData(form);
        // заголовки
        let headers = {
            "X-CSRF-TOKEN": this.csrfToken.getAttribute("content"),
        };
        // запрос на сервер
        ServerRequest.execute(
            this.URL,
            process,
            "post",
            this.msgElement,
            formData,
            headers
        );
    }
}
