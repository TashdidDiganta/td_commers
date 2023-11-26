
const cartContainer = document.getElementById('cart-container');

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

function addToCart(){
    
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