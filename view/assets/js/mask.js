/* Máscaras ER */
function mascara(o,f){
  v_obj = o
  v_fun = f
  setTimeout("execmascara()",1)
}

function execmascara() {
  v_obj.value=v_fun(v_obj.value)
}

function mskDate(v) {
  v = v.replace(/\D/g,"");
  v = v.replace(/^(\d{2})(\d)/g,"$1/$2");
  v = v.replace(/(\d)(\d{4})$/,"$1/$2");
  return v;
}

function mskCPF(v) {
  v = v.replace(/\D/g,"");
  v = v.replace(/(\d{3})(\d{3})(\d{3})(\d{2})$/,"$1.$2.$3-$4");
  return v;
}
