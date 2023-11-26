
const cartContainer = document.getElementById('cart-container');
const cartIcon = document.getElementById('cart');
const addCartBox = document.querySelector('.add-card');


// add to cart icon
const click = true;
cartIcon.addEventListener('click', function(){
    if(click){
        addCartBox.classList.add('active');
    } else{
        addCartBox.classList.remove('active');
    }
})

// cartIcon.addEventListener('click', function(){
//     addCartBox.classList.remove('active');
// })

function getProduct(getProduct){
    const id = getProduct.ID;
    // const img = getProduct.product_avatar;
    const title = getProduct.product_title;
    const description = getProduct.product_description; 
    const price = getProduct.product_price; 
    console.log(id,title,description,price)
    // console.log(product);
    const allProducts =  productArray(id,title,description,price)
    setDataInlocalStorage(allProducts);
    
}


//crate product array
function productArray(id, title,description,price){
    const getProduct = {ID : id,  product_title: title, product_description: description, product_price: price }
    const data = getDataFromLocalStorage('product')
    if(data === null || data === ""){
        return [getProduct];
    } else{
        const newProduct = [...data, getProduct];
        return newProduct;
    }

}


const fetchData = getDataFromLocalStorage('product');

addToCart(fetchData);


function addToCart(fetchData){
    let addCart = '';

    fetchData.map(item => {
        addCart += `
        <div class="order-item">
            <img src="${item.images}"/>
              <div  class="name">${item.product_title}</div>
               <div class="price" id="${item.ID}" price="${item.product_price}">${item.product_price}</div>
                <div class="right-margin">
                    <button onclick="udecressQuantitys(event)">-</button>
                    <input type="number" step="1" value="1"/>
                    <button onclick="incressQuantity(event)">+</button>
                </div>                    
               <span class="delete" onclick="deleteItem(${item.ID})"><i class="fa-solid fa-trash"></i></span>
        </div>
        `
    })

    cartContainer.innerHTML = addCart;
    
}

console.log(fetchData.map(i => i))


//get data from local Storage
function getDataFromLocalStorage(product){
    let data = localStorage.getItem(product);
    return JSON.parse(data)
}

// set data in local Storage
function setDataInlocalStorage(data){
    let saveData = JSON.stringify(data)
    localStorage.setItem('product', saveData)
}