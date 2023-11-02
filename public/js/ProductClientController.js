/** Фронт-контроллер таблицы */
class ProductClientController extends ClientController {
    // добавить запись в БД
    add(form, event) {
        event.preventDefault();
        let type = form.getAttribute('data-type');

        // действия после успешного добавления данных в БД
        let process = (data) => {
            //console.log(data);
            if (data.result == 1) {
                this.msgElement.textContent = type == 'add' ? 'товар добавлен' : 'данные обновлены';
            } else {
                this.msgElement.textContent = data.description;
            }
        };

        // данные формы
        let formData = new FormData(form);
        formData.set('id', form.getAttribute('data-id'));
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
