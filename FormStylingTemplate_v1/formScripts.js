


// Currency input for input=number. 
$('input[type="number"]').change(function() {
    var min = Globalize.parseFloat($(this).attr("min"));
    var max = Globalize.parseFloat($(this).attr("max"));
    var value = Globalize.parseFloat($(this).val());
    if(value < min) { value = min; }        
    if(value > max) { value = max; }
    $(this).val(value);
    //value = Globalize.format(value,"c");
    console.log(value);
    
});
