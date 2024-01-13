var laryngolodzy = document.getElementById("laryngolodzy")
var okuliści = document.getElementById("okuliści")
var lekarze_rodzinni = document.getElementById("lekarze_rodzinni")
var pediatrzy = document.getElementById("pediatrzy")
var doctor = document.getElementById("doctor")
    function lista(){
        laryngolodzy.style.display="none"
        okuliści.style.display="none"
        lekarze_rodzinni.style.display="none"
        pediatrzy.style.display="none"
    }
    doctor.addEventListener("change",()=>{
        lista()
        if(doctor.value==="laryngolog"){laryngolodzy.style.display="block"}
        else if(doctor.value==="okulista"){okuliści.style.display="block"}
        else if(doctor.value==="lekarz_rodzinny"){okuliści.style.display="block"}
        else if(doctor.value==="pediatra"){okuliści.style.display="block"}
    })

