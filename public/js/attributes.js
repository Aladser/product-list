// кнопка добавить аттрибут
const addAttrBtn = document.querySelector(`.${formClass}__add-attr`);
// кнопка секции атрибутов
const attributesSection = document.querySelector(`.${formClass}__attributes`);
// число атрибутов
let attributeCount = document.querySelectorAll(
    `.${formClass}__attribute`
).length;

// добавить атрибут
addAttrBtn.onclick = (e) => {
    e.preventDefault();
    attributeCount++;
    attributesSection.innerHTML += `                    
        <article class='${formClass}__attribute mb-4'>
            <div class='inline-block w-30percents me-2'>
                <label class='block w-2/3 text-white text-xs pb-2'>Название</label>
                <input type='text' class='${formClass}__attr-name w-full rounded'>
            </div>
            <div class='inline-block w-30percents me-2'>
                <label class='block w-2/3 text-white text-xs pb-2'>Значение</label>
                <input type='text' class='${formClass}__attr-value w-full rounded'>
            </div>
            <button class='${formClass}__btn-remove-attr'>🗑</button>
        </article>
    `;
    document
        .querySelectorAll(`.${formClass}__btn-remove-attr`)
        .forEach((btn) => {
            btn.onclick = removeAttr;
        });
};

// удалить атрибут
document.querySelectorAll(`.${formClass}__btn-remove-attr`).forEach((btn) => {
    btn.onclick = removeAttr;
});
function removeAttr(e) {
    e.preventDefault();
    e.target.closest(`.${formClass}__attribute`).remove();
}
