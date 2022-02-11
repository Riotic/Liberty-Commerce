
let actualCart={
    totalItems:0,
    totalPrice:0,
    products:[]
};


function buy(object) {
    
    let wasFounded = false;
    actualCart.products.forEach((product) =>{
         if (product.id === object.id){
             wasFounded=true;
             product.quantity++;
             actualCart.totalPrice+=object.product_price;
         }
     })

     if (!wasFounded){
         actualCart.products.push({
                 id : object.id,
                 name : object.title,
                 price : object.product_price,
                 description : object.product_description,
                 picture : object.picture,
                 quantity:1
         });
         actualCart.totalPrice+=object.product_price;
     }
    actualCart.totalItems++;
    
     diplayTotalItems();
     saveAcutalCart();
}

function diplayTotalItems(){
    document.querySelector('#cartTotalItems').innerHTML = "Panier ("+actualCart.totalItems+")";
    document.querySelector('#cartTotalItems2').innerHTML = "Panier ("+actualCart.totalItems+")";
}

function saveAcutalCart(){
    localStorage.setItem('Cart',JSON.stringify(actualCart));
}

function loadSavedCart(){
    const savedCart = JSON.parse(localStorage.getItem('Cart'));
    if(savedCart!==undefined && savedCart!==null)
    {
        actualCart=savedCart;
        diplayTotalItems();
    }
}
loadSavedCart();
///function update Cart items :

function updateCartItem(idProduct)
{
      let newQuantity = document.querySelector('#updInput'+idProduct).value
        actualCart.products.forEach(product =>{

          if (product.id === idProduct)
          {
            // console.log("Updating with new quantity "+newQuantity);
            if(newQuantity<=0)
            {
              remove(idProduct);
            }
            else
            {
              // quantity update & price update
              newQuantity = Number(newQuantity);
              actualCart.totalItems-=product.quantity;
              actualCart.totalPrice-=product.quantity*product.price;
              product.quantity =newQuantity;
              actualCart.totalItems+=product.quantity;
              actualCart.totalPrice+=product.quantity*product.price;           
            }
          }
        })
        saveAcutalCart();
}

function remove(idProduct)
{
  
  actualCart.products.forEach(product => {
    
    if(product.id==idProduct)
    {
      
      actualCart.totalPrice-= product.quantity*product.price;
      actualCart.totalItems -= product.quantity;
      for( var i = 0; i < actualCart.products.length; i++){                               
          if ( actualCart.products[i].id === idProduct) { 
            actualCart.products.splice(i, 1); 
              i--; 
          }
      }

    }
    else {console.log("rien trouvé pour le produit : " + idProduct)}
  })
  saveAcutalCart();

}

function checkout(){
  return route('cart.checkout');
}

function removeAll(){

  actualCart={
    totalItems:0,
    totalPrice:0,
    products:[]
  }
  saveAcutalCart();
  setTimeout( function() {location.reload() } ,250);
}
/// genate cart in js 


function generateCart(){ 
  

  //Cart Header
//Generate the header of the card 
// let Cart = document.querySelector('.Cart');
// let createHeader = document.createElement('div');
// createHeader.className = 'Header';
// Cart.appendChild(createHeader);

// genarate Heading title 
let header = document.querySelector('.Header');
let createHeading = document.createElement('h3');
createHeading.className = 'Heading';
createHeading.innerText = 'Shooping Cart';
header.appendChild(createHeading);

//generate button Remove All
let createH5 = document.createElement('h5');
createH5.id='h5';
header.appendChild(createH5);

let h5 = document.querySelector('#h5');
let btnRmAll = document.createElement('button');
btnRmAll.setAttribute("onclick","removeAll();");
btnRmAll.className = 'unset Action';
btnRmAll.innerText = 'Remove All';

h5.appendChild(btnRmAll);
  //Cart Content
// let CreateCorp = document.createElement('div')
// CreateCorp.className = 'Corp';
// Cart.appendChild(CreateCorp);
let i=0;
//Cart items Management
actualCart.products.forEach((product)=>
{
let corp = document.querySelector('.Corp');
let createCartItems = document.createElement('div');
createCartItems.className='Cart-Items';
corp.appendChild(createCartItems);
//Img - Box 
let CartItems = document.querySelectorAll('.Cart-Items')[i];
let CreateImgDiv = document.createElement('div');
CreateImgDiv.className = 'Image-box';
CartItems.appendChild(CreateImgDiv);
//Image

let divImg = document.querySelectorAll('.Image-box')[i];
CreateImg = document.createElement('img');
CreateImg.src = 'products_pictures/'+product.picture;
divImg.appendChild(CreateImg);
//About section
let createAbout = document.createElement('div');
createAbout.className = 'About';
CartItems.appendChild(createAbout);
//About Title
let About = document.querySelectorAll('.About')[i];
let CreateAboutTitle = document.createElement('h1');
CreateAboutTitle.className = 'Title';
CreateAboutTitle.innerText = product.description;
About.appendChild(CreateAboutTitle);
//Counter section
let createClassCounter = document.createElement('div');
createClassCounter.className = 'Counter';
CartItems.appendChild(createClassCounter);


//form
let CounterClass = document.querySelectorAll('.Counter')[i];
let createForm = document.createElement('form');
createForm.className = 'form';
CounterClass.appendChild(createForm);
//form input
let form = document.querySelectorAll('.form')[i];
let CreateInput = document.createElement('input');
CreateInput.type = 'number';
CreateInput.name = 'quantity';
CreateInput.id = 'updInput'+product.id;
CreateInput.value = product.quantity;
form.appendChild(CreateInput);

//form Update button
let createUpdateBtn = document.createElement('button');
createUpdateBtn.className = 'unset';
createUpdateBtn.type = 'submit';
createUpdateBtn.innerHTML = 'Update';
createUpdateBtn.setAttribute("onclick","updateCartItem("+product.id+");"); // need to create missing function here 
form.appendChild(createUpdateBtn);

let createPriceDiv = document.createElement('div');
createPriceDiv.className = 'Prices';
CartItems.appendChild(createPriceDiv);

let PriceDiv = document.querySelectorAll('.Prices')[i];
let createAmountDiv = document.createElement('div');
createAmountDiv.className = 'Amount';
createAmountDiv.innerHTML = product.price+'€ Unit Price<br>'+(product.price*product.quantity)+'€ Total Price';
PriceDiv.appendChild(createAmountDiv);

let createDivRemove = document.createElement('div');
createDivRemove.className = 'Remove';
PriceDiv.appendChild(createDivRemove);

let divRemove = document.querySelectorAll('.Remove')[i];
let createForm2 = document.createElement('form');
createForm2.className = 'form2';
divRemove.appendChild(createForm2);

let form2 = document.querySelectorAll('.form2')[i];
let btnRmv = document.createElement('button');
btnRmv.className='unset';
btnRmv.innerText = 'Remove';
btnRmv.setAttribute("onclick","remove("+product.id+");"); // need to create missing function here 
form2.appendChild(btnRmv);

i++;
})

let checkout = document.querySelector('.Checkout');
let createTotalClass = document.createElement('div');
createTotalClass.className = 'Total';
checkout.appendChild(createTotalClass);

let TotalClass = document.querySelector('.Total');
let CreateItems = document.createElement('div');
CreateItems.className = 'Items';
CreateItems.innerText = actualCart.totalItems+' Items dans le panier';
TotalClass.appendChild(CreateItems);

let CreateTotalAmount = document.createElement('div');
CreateTotalAmount.className = 'Total-amount';
CreateTotalAmount.innerText = 'Total: '+actualCart.totalPrice+'€';
checkout.appendChild(CreateTotalAmount);

document.querySelector('#order').value = JSON.stringify(actualCart.products);
document.querySelector('#qtyOfItems').value = actualCart.totalItems;
document.querySelector('#totalPrice').value = actualCart.totalPrice;
}
