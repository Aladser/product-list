/** Клиентский табличный контроллер
 * @param {*} URL серверного контроллера
 * @param {*} msgElement инфоэлемент
 * @param {*} form форма добавления
 */
const tableController = new ProductClientController(
    "/product",
    null,
    document.querySelector("#table-error"),
    document.querySelector(".form-new-product")
);

const addAttrBtn = document.querySelector('.form-new-product__add-attr');
const attributesSection = document.querySelector('.form-new-product__attributes');
let attributeCount = document.querySelectorAll('.form-new-product__attribute').length;

// добавить атрибут
addAttrBtn.onclick = (e) => {
    e.preventDefault();
    attributeCount++;
    attributesSection.innerHTML += `                    
        <article class='form-new-product__attribute mb-4'>
            <div class='inline-block w-30percents me-2'>
                <label class='block w-2/3 text-white text-xs pb-2'>Название</label>
                <input type='text' class='form-new-product__attr-name w-full rounded'>
            </div>
            <div class='inline-block w-30percents me-2'>
                <label class='block w-2/3 text-white text-xs pb-2'>Значение</label>
                <input type='text' class='form-new-product__attr-value w-full rounded'>
            </div>
            <button class='form-new-product__btn-remove-attr'>🗑</button>
        </article>
    `;
    document.querySelectorAll('.form-new-product__btn-remove-attr').forEach(btn => {
        btn.onclick = removeAttr;
    });
}

// удалить атрибут
function removeAttr(e) {
    e.preventDefault();
    e.target.closest('.form-new-product__attribute').remove();
}