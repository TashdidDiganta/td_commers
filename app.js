
const cartContainer = document.getElementById('cart-container');
const cartIcon = document.getElementById('cart');
const addCartBox = document.querySelector('.add-card');
const count = document.querySelector('.count');
const total = document.querySelector('.total');


// get data
let fetchData = getDataFromLocalStorage('product')? getDataFromLocalStorage('product') : [];
count.innerText = fetchData.length
addToCart(fetchData);


// add to cart icon
let click = true;
cartIcon.addEventListener('click', function(){
    if(click){
        addCartBox.classList.add('active');
         click = false
    } else{
        addCartBox.classList.remove('active');
        click = true
    }
})


function getProduct(getProduct){
    const id = getProduct.ID;
    const title = getProduct.product_title; 
    const price = getProduct.product_price; 
    const firstPrice = getProduct.product_price; 
    const images = getProduct.product_avatar; 

    const existingObject  = fetchData.find(i => i.ID == id)
    if(existingObject){
        console.log('exist');
        setTimeout(function(){ alert('This Product Already added!') }, 1000);
    } else{
        const allProducts =  productArray(id,title,price, images, firstPrice)
        addToCart(allProducts);
        count.innerText = allProducts.length
        setDataInlocalStorage(allProducts);

        addCartBox.classList.add('active');
        click = false;
    }
    
}


//crate product array
function productArray(id, title,price,images, firstPrice){
    const getProduct = {ID : id,  product_title: title, product_price: price, quantity:1, images, firstPrice}
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
            <img class="rounded" src="${item.images}"/>
              <div  class="name">${item.product_title}</div>
               <div class="price" id="${item.ID}" firstPrice="${item.firstPrice}" price="${item.product_price}">${item.product_price}</div>
                <div class="right-margin">
                    <button onclick="decressQuantitys(event)">-</button>
                    <input type="number" class="price-input" step="1" value="${item.quantity}"/>
                    <button onclick="incressQuantity(event)">+</button>
                </div>                    
               <span class="delete" style="cursor:'pointer';" onclick="deleteItem(${item.ID})"><i class="fa-solid fa-trash"></i></span>
        </div>
        `
      
    })



   const price = fetchData.reduce((acc, product)=>{
       return acc + parseInt( product.product_price)
    },0)

    total.innerText = price
    cartContainer.innerHTML = addCart

   
    

 
}



// incress price
function incressQuantity(e){
    const inputValue =  parseInt(e.target.previousElementSibling.value);
    const incressValue = parseInt(inputValue) + 1;
    e.target.previousElementSibling.value = incressValue;

    //set update price in local storage
    const priceID = e.target.parentElement.previousElementSibling.classList.contains('price')? parseFloat(e.target.parentElement.previousElementSibling.getAttribute('id')) : 0;
    const getLocalData = getDataFromLocalStorage('product')? getDataFromLocalStorage('product') : [];

    const newPrice = getLocalData.map(i => {
        if(i.ID == priceID){
            return {...i, quantity : incressValue }
        }
        return i;
    })

    setDataInlocalStorage(newPrice)
    totalPrice(newPrice)
}

// dec price
function decressQuantitys(e){
    const inputValue =  parseInt(e.target.nextElementSibling.value);
    const decressValue = parseInt(inputValue) - 1;
    e.target.nextElementSibling.value = decressValue;

    // //set update price in local storage
    const priceID = e.target.parentElement.previousElementSibling.classList.contains('price')? parseFloat(e.target.parentElement.previousElementSibling.getAttribute('id')) : 0;
    const getLocalData = getDataFromLocalStorage('product')? getDataFromLocalStorage('product') : [];

    const newPrice = getLocalData.map(i => {
        if(i.ID == priceID){
            return {...i, quantity : decressValue }
        }
        return i;
    })


    setDataInlocalStorage(newPrice)
    totalPrice(newPrice)
}


// total price 

function totalPrice(sumPrice){

    const totalPrice = sumPrice.reduce((acc, product) =>{
        return acc + (product.product_price * product.quantity)
    },0);

    console.log(totalPrice);


    total.innerText = totalPrice
}

totalPrice(fetchData);




//Delete cart item 
function deleteItem(id){
    const newArray = fetchData.filter(i => parseFloat(i.ID) !== id );
    count.innerText = newArray.length

    addToCart(newArray);
    setDataInlocalStorage(newArray);
}




