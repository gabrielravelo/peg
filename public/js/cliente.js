let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
  id: '',
  nombre: '',
  fecha: '',
  hora: '',
  servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
  iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
    servicios();
    nombrecliente(); // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita al objeto
    seleccionarHora(); // Añade la hora de la cita al objeto
    idCliente(); // Añade el id del cliente
    mostrarResumen(); // Muestra el resumen de la cita
};

function mostrarSeccion() {
  // Ocultar la seccion que tenga la clase de mostrar
  const seccionAnterior = document.querySelector('.mostrar');
  if(seccionAnterior)
    seccionAnterior.classList.remove('mostrar');

  // Seleccionar la seccion con el paso
  const pasoSelector = `#paso-${paso}`;
  const seccion = document.querySelector(pasoSelector);
  seccion.classList.add('mostrar');

  // Quitar la clase actual al tab anterior
  const tabAnterior = document.querySelector('.actual');
  if(tabAnterior)
    tabAnterior.classList.remove('actual');

  // Resaltar el tab actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add('actual');
};

function tabs() {
  const botones = document.querySelectorAll('.tabs button');

  botones.forEach( boton => {
    boton.addEventListener('click', function(e) {
      paso = parseInt(e.target.dataset.paso);

      mostrarSeccion();
      botonesPaginador();
    });
  });
};

function botonesPaginador() {
  const paginaAnterior = document.querySelector('#anterior');
  const paginaSiguiente = document.querySelector('#siguiente');

  if(paso === 1) {
    paginaAnterior.classList.add('ocultar');
    paginaSiguiente.classList.remove('ocultar');
  } else if(paso === 3) {
    paginaAnterior.classList.remove('ocultar');
    paginaSiguiente.classList.add('ocultar');

    mostrarResumen();
  } else {
    paginaAnterior.classList.remove('ocultar');
    paginaSiguiente.classList.remove('ocultar');
  }

  mostrarSeccion();
}

function paginaAnterior() {
  const paginaAnterior = document.querySelector('#anterior');
  paginaAnterior.addEventListener('click', function() {
    if(paso <= pasoInicial) return;
    paso--;

    botonesPaginador();

  });
}

function paginaSiguiente() {
  const paginaSiguiente = document.querySelector('#siguiente');
  paginaSiguiente.addEventListener('click', function() {
    if(paso >= pasoFinal) return;
    paso++;

    botonesPaginador();

  });
}

function servicios() {
    fetch('/api/servicios')
    .then( response => {
        return response.ok ? response.json() : Promise.reject(response)
    })
    .then( response => {
        mostrarServicios(response);
    })
    .catch(error => {
        console.log(error);
    })
}

function mostrarServicios(servicios) {
  servicios.forEach(servicio => {
    const {servicio_id, nombre, precio} = servicio;

    const nombreServicio = document.createElement('P');
    nombreServicio.classList.add('nombre-servicio');
    nombreServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.classList.add('precio-servicio');
    precioServicio.textContent = `$${precio}`;

    const servicioDiv = document.createElement('DIV');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = servicio_id;
    servicioDiv.onclick = function() {
      seleccionarServicio(servicio);
    };

    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);

    document.querySelector('#servicios').appendChild(servicioDiv);
  });
}

function seleccionarServicio(servicio) {
  const { servicio_id } = servicio;
  const { servicios } = cita;
  const divServicio = document.querySelector(`[data-id-servicio="${servicio_id}"]`)

  // Comprobar si el servicio ya fue agregado
  if( servicios.some( agregado => agregado.servicio_id === servicio_id )) {
    // Eliminarlo
    cita.servicios = servicios.filter( agregado => agregado.servicio_id !== servicio_id )
    divServicio.classList.remove('seleccionado');
  } else {
    // Agregarlo
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add('seleccionado');
  }
}

function idCliente() {
  cita.id = document.querySelector('#id').value;
}

function nombrecliente() {
  cita.nombre = document.querySelector('#nombre').value;
};

function seleccionarFecha() {
  const inputFecha = document.querySelector('#fecha');
  inputFecha.addEventListener('input', function(e) {

    const dia = new Date(e.target.value).getUTCDay();

    if( [0].includes(dia) ) {
      e.target.value = '';
      mostrarAlerta('Domingos no permitidos', 'error', '.formulario');
    } else {
      cita.fecha = e.target.value;
    }

  });
}

function seleccionarHora() {
  const inputHora = document.querySelector('#hora');
  inputHora.addEventListener('input', function(e) {

    const horaCita = e.target.value;
    const hora = horaCita.split(':')[0];

    if(hora < 8 || hora > 20) {
      e.target.value = '';
      mostrarAlerta('Hora no válida', 'error', '.formulario')
    } else {
      cita.hora = e.target.value;
    }
  })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

  const alertaPrevia = document.querySelector('.alerta');
  if(alertaPrevia) {
    alertaPrevia.remove();
  }

  const alerta = document.createElement('DIV');
  alerta.textContent = mensaje;
  alerta.classList.add('alerta');
  alerta.classList.add(tipo);

  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);

  if(desaparece) {
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}

function mostrarResumen() {
  const resumen = document.querySelector('.contenido-resumen');

  // Limpiar el contenido de resumen
  while(resumen.firstChild) {
    resumen.removeChild(resumen.firstChild);
  }

  if(Object.values(cita).includes('') || cita.servicios.length === 0) {
    mostrarAlerta('Faltan datos de servicios, fecha u hora', 'error', '.contenido-resumen', false);

    return;
  }

  // Formatear el div de resumen
  const { nombre, fecha, hora, servicios } = cita;

  // Heading para servicios en resumen
  const headingServicios = document.createElement('H3');
  headingServicios.textContent = 'Resumen de Servicios';
  resumen.appendChild(headingServicios);

  // Iterando y mostrando los servicios
  servicios.forEach(servicio => {
    const { id, precio, nombre } = servicio;

    const contenedorServicio = document.createElement('DIV');
    contenedorServicio.classList.add('contenedor-servicio');

    const textoServicio = document.createElement('P');
    textoServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);

    resumen.appendChild(contenedorServicio);
  });

  // Heading para cita en resumen
  const headingCita = document.createElement('H3');
  headingCita.textContent = 'Resumen de Cita';
  resumen.appendChild(headingCita);

  const nombreCliente = document.createElement('P');
  nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

  // Formatear la fecha en español
  const fechaObj = new Date(fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2;
  const year = fechaObj.getFullYear();

  const fechaUTC = new Date( Date.UTC(year, mes, dia));

  const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
  const fechaFormateada = fechaUTC.toLocaleDateString('es-VE', opciones);

  const fechaCita = document.createElement('P');
  fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

  const horaCita = document.createElement('P');
  horaCita.innerHTML = `<span>Hora:</span> ${hora} horas`;

  // Boton para crear una cita
  const botonReservar = document.createElement('BUTTON');
  botonReservar.classList.add('boton');
  botonReservar.textContent = 'Reservar cita';
  botonReservar.onclick = reservarCita;

  resumen.appendChild(nombreCliente);
  resumen.appendChild(fechaCita);
  resumen.appendChild(horaCita);
  resumen.appendChild(botonReservar);
}

async function reservarCita() {
    const { id, nombre, fecha, hora, servicios } = cita;
    const idServicios = servicios.map( servicio => servicio.servicio_id );

    const datos = new FormData();
    datos.append('nombre', nombre);
    datos.append('usuario_id', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicios);

    try {
        // Peticion hacia la API
        const url = 'http://127.0.0.1:8000/api/crear-cita';

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if(resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita creada',
                text: 'Tu cita fue creada exitosamente!',
                button: 'OK'
            }).then( () => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita',
        })
    }
}