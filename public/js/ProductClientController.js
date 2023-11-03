/** Фронт-контроллер таблицы */
class ProductClientController extends ClientController {
    constructor(URL, table, msgPrg, form = null, formClass) {
        super(URL, table, msgPrg, form);
        this.formClass = formClass;
    }

    // добавить запись в БД
    add(form, event) {
        event.preventDefault();
        let type = form.getAttribute("data-type");

        // атрибуты
        let data = new Map();
        let attributesElements = document.querySelectorAll(
            `.${this.formClass}__attribute`
        );
        if (attributesElements.length > 0) {
            attributesElements.forEach((element) => {
                let name = element.querySelector(
                    `.${this.formClass}__attr-name`
                ).value;
                let value = element.querySelector(
                    `.${this.formClass}__attr-value`
                ).value;
                if (name !== "" && value !== "") {
                    data.set(name, value);
                }
            });
        }
        data = JSON.stringify(Object.fromEntries(data));

        // действия после успешного добавления данных в БД
        let process = (data) => {
            if (data.result == 1) {
                this.msgElement.textContent =
                    type == "add"
                        ? `${data.row.articul}: ${data.row.name} добавлен`
                        : "данные обновлены";
            } else {
                this.msgElement.textContent = data.description;
            }
        };

        let formData = new FormData(form);
        formData.set("data", data);
        // id, если редактирование
        let idAttr = form.getAttribute("data-id");
        if (idAttr) {
            formData.set("id", idAttr);
        }
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
