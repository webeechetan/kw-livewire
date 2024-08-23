




// find .note-editable container and get all tables and add border to them

function addBorder(){
    var tables = document.querySelectorAll('.note-editable table');
    for (var i = 0; i < tables.length; i++) {
        $(tables[i]).attr('border', '1');
        console.log('table', tables[i]);
    }
} 


setTimeout(addBorder, 5000);

$(document).ready(function(){
    
});