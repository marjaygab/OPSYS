document.querySelector("html").classList.add('js');
var fileInput  = document.querySelector( ".input-file" ),
button     = document.querySelector( ".input-file-trigger" ),
the_return = document.querySelector(".file-return");

button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});

button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});

fileInput.addEventListener( "change", function( event ) {
    the_return.innerHTML = this.value;
});
  var p = 6;
  var j = 0;
  var button = document.getElementById("my-button");
  var times = 0;
  var title = document.getElementById("title");
  var time = -1;
  var myInterval;
  var tbl = document.getElementById('my-table'), // table reference
  row = tbl.insertRow(tbl.rows.length),i;
  var execute_btn = document.getElementById('execute-btn');
  var step_btn = document.getElementById('step-btn');

  button.addEventListener("click", function(event){
    myInterval = setInterval (function(){
    time ++;
    //appendRow(j++);
    title.innerHTML = time;
    }, 1000);
  });

  function appendRow(j,k) {
    var tbl = document.getElementById('my-table'), // table reference
    row = tbl.insertRow(tbl.rows.length),i;
    var str = j.toString();
    // insert table cells to the new row
    //for (i = 0; i < tbl.rows[0].cells.length; i++) {
      //if (i==0) {
        createCell(row.insertCell(0), 'str', 'row');
      //}else{
        createCell(row.insertCell(1), k, 'row');
      //}

    //}
  }

// create DIV element and append to the table cell
  function createCell(cell, text, style) {
    var div = document.createElement('div'), // create DIV element
        txt = document.createTextNode(text); // create text node
    div.appendChild(txt);                    // append text node to the DIV
    div.setAttribute('class', style);        // set DIV class attribute
    div.setAttribute('className', style);    // set DIV class attribute for IE (?!)
    cell.appendChild(div);                   // append DIV to the table cell
  }
