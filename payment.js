const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_370ff02561e3798c999cf1db982a13035a6c652b', // Replace with your public key
    email: document.getElementById("email").value,
    amount: document.getElementById("amount").value * 100,
    currency: 'NGN',
    ref:document.getElementById("orderid").value,
    //ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      console.log(response);
      $.ajax({
        url: "updatepayments.php",
        type: "POST",
        data: {
            status:response.status,
            orderid:response.reference
        },
        success: function(response) {
            alert(response);
            matchFound = true;
        },
        error: function() {
            alert("Error prosessing your payment. Please try again.");
        }
    });
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      
    }
  });

  handler.openIframe();
}