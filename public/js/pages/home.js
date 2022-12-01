(()=>{function e(e,r){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var r=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null==r)return;var n,o,a=[],c=!0,s=!1;try{for(r=r.call(e);!(c=(n=r.next()).done)&&(a.push(n.value),!t||a.length!==t);c=!0);}catch(e){s=!0,o=e}finally{try{c||null==r.return||r.return()}finally{if(s)throw o}}return a}(e,r)||function(e,r){if(!e)return;if("string"==typeof e)return t(e,r);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return t(e,r)}(e,r)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function t(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}var r=document.querySelector("#phoneInput");window.phoneNumberInput=intlTelInput(r,{separateDialCode:!0});var n=document.querySelector("#form-wrapper form"),o=n.querySelectorAll("input, select, textarea");if(n instanceof HTMLFormElement){var a=function(){r.classList.add("error")};n.addEventListener("submit",(function(e){e.preventDefault();var t=n.querySelector("button[type=submit]");t instanceof HTMLButtonElement&&(t.disabled=!0,t.innerHTML='<i class="fa fa-spinner fa-spin"></i>');var r=new FormData;r.set("first_name",document.querySelector("#firstNameInput").value),r.set("last_name",document.querySelector("#lastNameInput").value),r.set("email",document.querySelector("#emailInput").value),r.set("age",document.querySelector("#ageInput").value),r.set("height",document.querySelector("#heightInput").value),r.set("weight",document.querySelector("#weightInput").value),r.set("gender",document.querySelector("#genderInput").value),r.set("social_network_note",document.querySelector("#socialNetworkInput").value),r.set("country_id",document.querySelector("#countryInput").value),r.set("phone_number",document.querySelector("#phoneInput").value),r.set("phone_code",phoneNumberInput.selectedCountryData.dialCode),r.set("front_side",document.querySelector("#frontSideInput").files[0]),r.set("front_closed",document.querySelector("#frontClosedInput").files[0]),r.set("right_side",document.querySelector("#rightSideInput").files[0]),r.set("right_closed",document.querySelector("#rightClosedSideInput").files[0]),axios.post("/api/apply",r,{headers:{"Content-Type":"application/x-www-form-urlencoded",Accept:"application/json"}}).then((function(e){t.innerHTML="Apply",$(n).find(".dropdown img").toArray().forEach((function(e){e.src=e.getAttribute("data-src")})),t.disabled=!1,document.querySelector("#error-feedback").innerText="",document.querySelector("#success-feedback").innerText=e.data.message,n.reset(),o.forEach((function(e){e.removeEventListener("invalid",a,!1)}))})).catch((function(e){t.innerHTML="Apply",t.disabled=!1,e.response&&422===e.response.status?document.querySelector("#error-feedback").innerText=e.response.data.errors?Object.values(e.response.data.errors).join("\n"):e.response.data.message:e.response&&toastr.error(e.response.data.message),console.log(e)}))})),o.forEach((function(e){e.addEventListener("invalid",a,!1)}))}n.querySelectorAll("input[type=file]").forEach((function(e){e.addEventListener("change",g)}));var c=document.querySelector("#use-picture"),s=document.querySelector("#retake-picture"),i=document.querySelector("#take-picture"),u=document.getElementById("picture-controls"),l=document.getElementById("webcam-live"),d=document.getElementById("picture-canvas");l.width=1200;var p=new Webcam.default(l,"user",d),m=null,f=null;function y(){l.classList.remove("mx-w-full"),f=p.snap(),l.classList.add("mx-w-full"),l.classList.add("d-none"),d.classList.remove("d-none"),d.classList.add("mx-w-full"),u.classList.remove("d-none"),u.classList.add("d-flex"),i.classList.add("d-none"),c.removeEventListener("click",v),c.addEventListener("click",v),s.removeEventListener("click",h),s.addEventListener("click",h)}function v(){p.stop(),$("#previewSnapshotModal").modal("hide"),$('.dropdown[data-target="'.concat(m,'"] img')).attr("src",f),fetch(f).then((function(e){return e.blob()})).then((function(e){var t=new File([e],"image.png",{type:e.type}),r=new DataTransfer;r.items.add(t),document.querySelector("input#"+m).files=r.files,h()}))}function h(){l.classList.remove("d-none"),d.classList.add("d-none"),d.classList.remove("mx-w-full"),u.classList.add("d-none"),u.classList.remove("d-flex"),i.classList.remove("d-none")}function g(t){var r=e(t.currentTarget.files,1)[0],n=t.currentTarget.labels[0],o=t.currentTarget.labels[1];r?($(o).parents(".dropdown:first").find("img").attr("src",URL.createObjectURL(r)),n.querySelector("img").src=URL.createObjectURL(r)):($(o).parents(".dropdown:first").find("img").attr("src",$(n).parents(".dropdown:first").find("img").attr("data-src")),n.querySelector("img").src=n.querySelector("img").getAttribute("data-src"))}document.querySelector("#previewSnapshotModal").addEventListener("hide.bs.modal",(function(){p.stop(),h()})),n.querySelectorAll(".request-take-picture-btn").forEach((function(e){e.addEventListener("click",(function(){!function(e){$("#previewSnapshotModal").modal("show"),m=$(e).parents(".dropdown:first").attr("data-target");var t=$("input#"+m).attr("data-text");$("#previewSnapshotModalLabel").text("Take Picture - "+t),p.start().then((function(){i.removeEventListener("click",y),i.addEventListener("click",y)})).catch((function(e){console.log(e)}))}(e)}))}))})();
//# sourceMappingURL=home.js.map