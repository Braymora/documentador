const filasDatos = document.querySelectorAll(".fila-datos");

filasDatos.forEach((fila) => {
   const estadoFile = fila.querySelector("[name=estado_historial]");
   const codigoFile = fila.querySelector("[name=codigo_historial]");

   // Funciones para errores
   const setError = (message, field, esError = true) => {
      if (esError) {
         field.classList.add("invalid");
      } else {
         field.classList.remove("invalid");
         field.nextElementSibling.innerText = "";
      }
   };

   // Validando que existan datos
   const validateEmptyField = (message, e) => {
      const field = e.target;
      const fieldValue = e.target.value;

      if (fieldValue.trim().length === 0) {
         setError(message, field);
      } else {
         setError("", field, false);
      }
   };

   estadoFile.addEventListener("blur", (e) => validateEmptyField("", e));
   codigoFile.addEventListener("blur", (e) => validateEmptyField("Ingresa por favor el código", e));
});

