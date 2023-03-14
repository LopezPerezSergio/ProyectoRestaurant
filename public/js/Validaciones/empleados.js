const expresionesRegulares = {
    nombre:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/,
    apellidos:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/,
    telefono:/^[0-9]{10}$/,
    sueldo:/^([0-9]{1,3}\.[0-9]{2})$/,
    codigoAcceso:/^[0-9]{4}$/,


};
validator([
    [document.getElementById("nombre"), expresionesRegulares.nombre],
    [document.getElementById("apellidos"), expresionesRegulares.apellidos],
    [document.getElementById("telefono"), expresionesRegulares.telefono],
    [document.getElementById("sueldo"), expresionesRegulares.sueldo],
    [document.getElementById("codigoAcceso"), expresionesRegulares.codigoAcceso],
]);
