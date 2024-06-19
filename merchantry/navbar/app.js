let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

let products = [
    {
        id: 1,
        name: 'Tania',
        image: 'images_navbar/kategori/1.jpg',
        price: 200000
    },
    {
        id: 2,
        name: 'rjeans',
        image: 'images_navbar/kategori/2.jpg',
        price: 99000
    },
    {
        id: 3,
        name: 'Foral',
        image: 'images_navbar/kategori/3.jpg',
        price: 69000
    },
    {
        id: 4,
        name: 'Jwmpy',
        image: 'images_navbar/kategori/4.jpg',
        price: 1289000
    },
    {
        id: 5,
        name: 'Greely',
        image: 'images_navbar/kategori/5.jpg',
        price: 55000
    },
    {
        id: 6,
        name: 'Kiara',
        image: 'images_navbar/kategori/6.jpg',
        price: 120000
    },
    {
        id: 7,
        name: 'Tunikk',
        image: 'images_navbar/kategori/Tunikkk.jpg',
        price: 120000
    },
    {
        id: 8,
        name: 'Ardani Blouse',
        image: 'images_navbar/kategori/7.jpeg',
        price: 250000
    },
    {
        id: 9,
        name: 'Burberry Blouse',
        image: 'images_navbar/kategori/8.jpeg',
        price: 78000
    },
    {
        id: 10,
        name: 'Baby Crepe ori Pinkan & Gaffa',
        image: 'images_navbar/kategori/9.jpeg',
        price: 120000
    },
    {
        id: 11,
        name: 'Arafah',
        image: 'images_navbar/kategori/10.jpeg',
        price: 350000
    },
    {
        id: 12,
        name: 'Melinda Blouse',
        image: 'images_navbar/kategori/11.jpg',
        price: 120000
    },
    {
        id: 13,
        name: 'Zea Puffy Blouse Shakilla Blouse',
        image: 'images_navbar/kategori/12.jpeg',
        price: 60000
    },
    {
        id: 14,
        name: 'Dz Jii hoo Combie Kerah Crop',
        image: 'images_navbar/kategori/13.jpeg',
        price: 60000
    },
];
let listCards  = [];
function initApp(){
    products.forEach((value, key) =>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="MasukkanKeranjang(${key})">Masukkan Keranjang</button>`;
        list.appendChild(newDiv);
    });
}
initApp();
function MasukkanKeranjang(key){
    if(listCards[key] == null){
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key)=>{
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
                listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}
