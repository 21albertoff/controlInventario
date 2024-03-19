var hoy = new Date();
var hora = hoy.getHours();
document.body.classList.toggle('dark');
if (hora >= 16 ){
    document.body.classList.toggle('dark');
}
