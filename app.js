
const cartContainer = document.getElementById('cart-container');
const cartIcon = document.getElementById('cart');
const addCartBox = document.querySelector('.add-card');
const count = document.querySelector('.count');


// get data
const fetchData = getDataFromLocalStorage('product')? getDataFromLocalStorage('product') : [];
count.innerText = fetchData.length
addToCart(fetchData);


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
    const title = getProduct.product_title; 
    const price = getProduct.product_price; 
    // console.log(product);
    const allProducts =  productArray(id,title,price)
    addToCart(allProducts);
    count.innerText = allProducts.length

    setDataInlocalStorage(allProducts);
    
}


//crate product array
function productArray(id, title,price){
    const getProduct = {ID : id,  product_title: title, product_price: price, quantity:1}
    const data = getDataFromLocalStorage('product')
    if(data === null || data === ""){
        return [getProduct];
    } else{
        const newProduct = [...data, getProduct];
        return newProduct;
    }

}



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





//show all cart item
function addToCart(fetchData){
    let addCart = '';

    fetchData.map(item => {
        addCart += `
        <div class="order-item">
            <img src="${item.images}"/>
              <div  class="name">${item.product_title}</div>
               <div class="price" id="${item.ID}" price="${item.product_price}">${item.product_price}</div>
                <div class="right-margin">
                    <button onclick="decressQuantitys(event)">-</button>
                    <input type="number" class="price-input" step="1" value="1"/>
                    <button onclick="incressQuantity(event)">+</button>
                </div>                    
               <span class="delete" style="cursor:'pointer';" onclick="deleteItem(${item.ID})"><i class="fa-solid fa-trash"></i></span>
        </div>
        `
    })

    cartContainer.innerHTML = addCart;
}

// incress price

function incressQuantity(e){
    const inputValue =  parseInt(e.target.previousElementSibling.value);
    const incressValue = parseInt(inputValue) + 1;
    e.target.previousElementSibling.value = incressValue;

    const priceField = e.target.parentElement.previousElementSibling.classList.contains('price')? parseFloat(e.target.parentElement.previousElementSibling.getAttribute('price')) : 0;
    const productPrice = parseFloat(priceField * incressValue);
    e.target.parentElement.previousElementSibling.innerText = productPrice;
    
    //set update price in local storage
    const priceID = e.target.parentElement.previousElementSibling.classList.contains('price')? parseFloat(e.target.parentElement.previousElementSibling.getAttribute('id')) : 0;
    const getLocalData = getDataFromLocalStorage('product')? getDataFromLocalStorage('product') : [];

    const newPrice = getLocalData.map(i => {
        console.log(i.ID);
        console.log(priceID)
        if(i.ID === priceID){
            return {...i, quantity : incressValue}
        }

        return i;
    })


    setDataInlocalStorage(newPrice)


}


//Delete cart item 
function deleteItem(id){
    console.log(id)
    const newArray = fetchData.filter(i => i.ID !== id )
    console.log(newArray)
}




