function makeRow(tableID,cells,classname){
  var table = document.getElementById(tableID);
  var tableSize = table.rows.length;
  var row = table.insertRow(tableSize);
  for (var i = 0; i < cells.length; i++) {
    var cell = row.insertCell(i);
    var div = document.createElement('div');
    var txt = document.createTextNode(cells[i]);
    div.appendChild(txt);
    div.setAttribute('class',classname);
    cell.appendChild(div);
  }
}
