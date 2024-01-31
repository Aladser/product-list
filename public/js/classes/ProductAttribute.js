class ProductAttribute {
    constructor(formId, addAttrBtn, attributesSection) {
        this.formId = formId;
        this.attributesSection = attributesSection;
        // удалить атрибут
        document.querySelectorAll(`.${formClass}__btn-remove-attr`).forEach((btn) => btn.onclick = (e) => this.remove(e));
        // добавить атрибут
        this.addAttrBtn = addAttrBtn;
        this.addAttrBtn.onclick = (e) => this.add(e);
    }

    // число атрибутов
    getAttributeCount() {
        return document.querySelectorAll(`.${this.formId}__attribute`).length;
    }

    // добавить атрибут
    add(e) {
        e.preventDefault();
        this.attributesSection.innerHTML += `                    
            <article class='${this.formId}__attribute mb-4'>
                <div class='inline-block w-30percents me-2'>
                    <label class='block w-2/3 text-white text-xs pb-2'>Название</label>
                    <input type='text' class='${this.formId}__attr-name w-full rounded'>
                </div>
                <div class='inline-block w-30percents me-2'>
                    <label class='block w-2/3 text-white text-xs pb-2'>Значение</label>
                    <input type='text' class='${this.formId}__attr-value w-full rounded'>
                </div>
                <button class='${this.formId}__btn-remove-attr'>🗑</button>
            </article>
        `;
        document
            .querySelectorAll(`.${this.formId}__btn-remove-attr`)
            .forEach((btn) => {
                btn.onclick = (e) => this.remove(e);
            });
    };

    // удалить атрибут
    remove(e) {
        e.preventDefault();
        e.target.closest(`.${formClass}__attribute`).remove();
    }
}
