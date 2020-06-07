/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

  var shoppingCart = (function() {
  // =============================
  // Private methods and propeties
  // =============================

  cart = [];
  
  // Constructor
  function Item(name, price, count,thumb,cur,id,sale) {
    this.name   = name;
    this.price  = price;
    this.count  = count;
    this.thumb  = thumb;
    this.cur    = cur;
    this.id     = id;
    this.sale   = sale;
  }
  
  /*----------------------------------------------------------------------
  | Save Cart
  ------------------------------------------------------------------------*/
  function saveCart() {
    sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
  }
  
  /*----------------------------------------------------------------------
  | Load cart
  ------------------------------------------------------------------------*/
  function loadCart() {
    cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
  }

  if (sessionStorage.getItem("shoppingCart") != null) {
    loadCart();
  }
  

  // =============================
  // Public methods and propeties
  // =============================

  var obj = {};
  
  /*----------------------------------------------------------------------
  | Add item to cart
  ------------------------------------------------------------------------*/
  obj.addItemToCart = function(name, price, count,thumb,cur,id,sale) {
    for(var item in cart) {
      if(cart[item].id === id) {
        popnotificaton('Sorry this item is already exists in your cart','danger');
        return;
      }
    }
    var item = new Item(name, price, count,thumb,cur,id,sale);
    cart.push(item);
    popnotificaton('Domain :  <b>'+name+'</b> Added to the cart','dark');
    saveCart();
  }

  /*----------------------------------------------------------------------
  | Set count from item
  ------------------------------------------------------------------------*/
  obj.setCountForItem = function(name, count) {
    for(var i in cart) {
      if (cart[i].name === name) {
        cart[i].count = count;
        break;
      }
    }
  };

  /*----------------------------------------------------------------------
  | Remove item from cart
  ------------------------------------------------------------------------*/
  obj.removeItemFromCart = function(name) {
      for(var item in cart) {
        if(cart[item].name === name) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveCart();
  }

  /*----------------------------------------------------------------------
  | Remove all items from cart
  ------------------------------------------------------------------------*/
  obj.removeItemFromCartAll = function(name) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  /*----------------------------------------------------------------------
  | Clear Cart
  ------------------------------------------------------------------------*/
  obj.clearCart = function() {
    cart = [];
    saveCart();
  }

  /*----------------------------------------------------------------------
  | Count Cart
  ------------------------------------------------------------------------*/
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

   /*----------------------------------------------------------------------
  | Total Cart
  ------------------------------------------------------------------------*/
  obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].count;
    }
    return Number(totalCart.toFixed(2));
  }

  /*----------------------------------------------------------------------
  | List Cart
  ------------------------------------------------------------------------*/
  obj.listCart = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
      cartCopy.push(itemCopy)
    }
    return cartCopy;
  }

  return obj;
})();


  // *****************************************
  // Triggers / Events
  // ***************************************** 

  /*----------------------------------------------------------------------
  | Add Item
  ------------------------------------------------------------------------*/
  $(document).on('click','.add-to-cart',function(event){
    event.preventDefault();
    var name  = $(this).data('name');
    var price = Number($(this).data('price'));
    var thumb = $(this).data('thumb');
    var cur   = $(this).data('cur');
    var id    = $(this).data('id');
    var sale  = $(this).data('sale');
    if(userID !== ''){
      shoppingCart.addItemToCart(name, price, 1,thumb,cur,id,sale);
      displayCart();
    }
    else
    {
      popnotificaton('<b> Please login to add to cart </b>','info');
      setTimeout(function(){
        window.location.replace(baseUrl+"login");
      }, 2000);
      return false;
    }
  });

  /*----------------------------------------------------------------------
  | Add Item Own Cart Warning
  ------------------------------------------------------------------------*/
  $(document).on('click','.add-to-cart-own',function(event){
    event.preventDefault();
    popnotificaton('Sorry this item belongs to you','danger');
    return;
  });


  /*----------------------------------------------------------------------
  | Login Warning Message
  ------------------------------------------------------------------------*/
  $(document).on('click','.own-listing',function(event){
    event.preventDefault();
    if(userID === ''){
      popnotificaton('<b> Please login to continue </b>','info');
      setTimeout(function(){
        window.location.replace(baseUrl+"login");
      }, 2000);
      return false;
    }
  });

  /*----------------------------------------------------------------------
  | Clear All Items
  ------------------------------------------------------------------------*/
  $(document).on('click','.clear-cart',function(event){
    shoppingCart.clearCart();
    displaySummaryCheckout();
    displayCart();
  });

  /*----------------------------------------------------------------------
  | Display Cart Summary on Checkout page
  ------------------------------------------------------------------------*/
  function displaySummaryCheckout() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for(var i in cartArray) {
      output += "<li>"+cartArray[i].name +"<span>"+cartArray[i].cur+" "+cartArray[i].price+"</span></li>"
    }
    $('.checkout-items').html(output);
    $('.total-cost').html(shoppingCart.totalCart());
    $('.discount-type').html('0%');
    $('.total-discount').html('$0.00');
    $('.noofitems-summary').html('(<b>'+shoppingCart.totalCount()+'</b>)');
  }

  /*----------------------------------------------------------------------
  | Display Cart 
  ------------------------------------------------------------------------*/
  function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for(var i in cartArray) {
        output += "<li class='notifications-not-read'>"
        +"<a href='#'>"
        +"<span class='notification-avatar status-online'><img src='"+cartArray[i].thumb+"' alt='"+cartArray[i].name+"'></span>"
        +"<div class='notification-text'>"
        +"<strong>"+cartArray[i].name+"</strong> "
        +"<p class='notification-msg-text'> | Quantity : "+cartArray[i].count+"</p><br>"
        +"<span class='color'>Price : "+cartArray[i].cur+""+cartArray[i].price+"</span> "
        +"</div></a></li>";
    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
  }

  /*----------------------------------------------------------------------
  | Delete Item By Item
  ------------------------------------------------------------------------*/
  $('.show-cart').on("click", ".delete-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
  })


  /*----------------------------------------------------------------------
  | -1
  ------------------------------------------------------------------------*/
  $('.show-cart').on("click", ".minus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCart(name);
    displayCart();
  })

  /*----------------------------------------------------------------------
  | +1
  ------------------------------------------------------------------------*/
  $('.show-cart').on("click", ".plus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.addItemToCart(name);
    displayCart();
  })

  /*----------------------------------------------------------------------
  | Item Count
  ------------------------------------------------------------------------*/
  $('.show-cart').on("change", ".item-count", function(event) {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
  });
  displayCart();

  /*----------------------------------------------------------------------
  | Output Notifications
  ------------------------------------------------------------------------*/
  function popnotificaton(message , type){
    $.notify({
      message: message 
      },{
      type: type,
      delay: 100,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      }
    });
  }