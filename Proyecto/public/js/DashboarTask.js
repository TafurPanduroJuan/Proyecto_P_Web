class Task{
    constructor(nombre){
        this.nombre=nombre;
    }
}





document.getElementById("formulario").addEventListener("submit",(e)=>{

    e.preventDefault();

    const tareaInput= document.getElementById("task").value;
    const tarea=new Task(tareaInput);


    const nuevaTarea= document.createElement("div");
    nuevaTarea.classList.add("task");
    nuevaTarea.innerHTML = `<p>${tarea.nombre}</p><button class="delete-btn">✖</button>`;

    nuevaTarea.querySelector(".delete-btn").addEventListener("click", () => {
        nuevaTarea.remove();
    });


    document.querySelector(".task_container").appendChild(nuevaTarea);
    document.getElementById("task").value = ""


})