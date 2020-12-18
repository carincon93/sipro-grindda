<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <h5>Personal</h5>
                <p class="campo-explicacion">
                    <small>Selecciona el tipo de personal que apoyará el desarrollo de tu proyecto.</small>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opcionPersonalInterno" v-model="checkedPersonalInterno" id="checkPersonalInterno">
                    <label class="form-check-label" for="checkPersonalInterno">
                        Personal interno (Tecnoparque-Tecnoacademia-SENNOVA-Investigadores del grupo de investigación GRINDDA-Otros)
                    </label>
                </div>
                <div v-if="checkedPersonalInterno" class="mt-4">
                    <label for="cantidadPersonalInterno">Cantidad de personal interno</label>
                    <select id="cantidadPersonalInterno" class="custom-select select-small" name="cantidadPersonalInterno" v-model.number="cantidadPersonalInterno" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div v-for="(cantidadPi, index) in cantidadPersonalInterno" class="aliados-items mt-5">

                        <h1>Personal Interno Nro. {{ index + 1 }}</h1>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalInternoNombre'+index">Nombre completo</label>
                            <input :id="'personalInternoNombre'+index" type="text" name="personalInternoNombre[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalInternoNombre.'+index]}" maxlength="191" required>

                            <span v-if="errors['personalInternoNombre.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalInternoNombre.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalInternoDocumento'+index">Número de documento</label>
                            <input :id="'personalInternoDocumento'+index" type="number" min="0" max="99999999999" name="personalInternoDocumento[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalInternoDocumento.'+index]}" required>
                            <span v-if="errors['personalInternoDocumento.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalInternoDocumento.'+index][0] }}</strong>
                            </span>
                        </div>

                    </div>
                </div>

                <img :src="asset+'images/separator.png'" alt="" class="separador img-fluid">

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p class="campo-explicacion">
                    <small>Selecciona el tipo de personal instructor que apoyará el desarrollo de tu proyecto.</small>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opcionPersonalInstructor" v-model="checkedPersonalInstructor" id="checkPersonalInstructor">
                    <label class="form-check-label" for="checkPersonalInstructor">
                        Personal instructor
                    </label>
                </div>
                <div v-if="checkedPersonalInstructor" class="mt-4">
                    <label for="cantidadPersonalInstructor">Cantidad de personal instructor</label>
                    <select id="cantidadPersonalInstructor" class="custom-select select-small" name="cantidadPersonalInstructor" v-model.number="cantidadPersonalInstructor" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div v-for="(cantidadPinst, index) in cantidadPersonalInstructor" class="aliados-items mt-5">
                        <h1>Personal Instructor Nro. {{ index + 1 }}</h1>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalInstructorNombre'+index">Nombre completo</label>
                            <input :id="'personalInstructorNombre'+index" type="text" name="personalInstructorNombre[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalInstructorNombre.'+index]}" maxlength="191" required>
                            <span v-if="errors['personalInstructorNombre.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalInstructorNombre.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalInstructorDocumento'+index">Número de documento</label>
                            <input :id="'personalInstructorDocumento'+index" type="number" min="0" max="99999999999" name="personalInstructorDocumento[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalInstructorDocumento.'+index]}" required>
                            <span v-if="errors['personalInstructorDocumento.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalInstructorDocumento.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalInstructorCarta'+index">
                                Carta de compromiso
                                <p class="small">Máximo: 800KB. Formato: PDF</p>
                            </label>
                            <input :id="'personalInstructorCarta'+index" type="file" name="personalInstructorCarta[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalInstructorCarta.'+index]}" accept="application/pdf" required>
                            <span v-if="errors['personalInstructorCarta.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalInstructorCarta.'+index][0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-md-3">
                <p class="campo-explicacion">
                    <small>Selecciona el tipo de personal externo que apoyará el desarrollo de tu proyecto.</small>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opcionPersonalExterno" v-model="checkedPersonalExterno" id="checkPersonalExterno">
                    <label class="form-check-label" for="checkPersonalExterno">
                        Personal externo
                    </label>
                </div>
                <div v-if="checkedPersonalExterno">
                    <label for="cantidadPersonalExterno">Cantidad de personal externo</label>
                    <select id="cantidadPersonalExterno" class="custom-select select-small" name="" v-model.number="cantidadPersonalExterno">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div v-for="(cantidadPext, index) in cantidadPersonalExterno" class="aliados-items mt-5">
                        <h1>Personal Externo Nro. {{ index + 1 }}</h1>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalExternoNombre'+index">Nombre completo</label>
                            <input :id="'personalExternoNombre'+index" type="text" name="personalExternoNombre[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalExternoNombre.'+index]}" maxlength="191" required>
                            <span v-if="errors['personalExternoNombre.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalExternoNombre.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required">
                            <label :for="'personalExternoDocumento'+index">Número de documento</label>
                            <input :id="'personalExternoDocumento'+index" type="number" min="0" max="99999999999" name="personalExternoDocumento[]" class="form-control" v-bind:class="{'is-invalid' : errors['personalExternoDocumento.'+index]}" required>
                            <span v-if="errors['personalExternoDocumento.'+index]" class="invalid-feedback">
                                <strong>{{ errors['personalExternoDocumento.'+index][0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

</template>

<script type="text/javascript">
export default {
    props: ['errors'],
    data: function () {
        return {
            asset: asset,
            cantidadPersonalInterno: [],
            cantidadPersonalInstructor: [],
            // cantidadPersonalExterno: [],

            checkedPersonalInterno: false,
            checkedPersonalInstructor: false,
            // checkedPersonalExterno: false,
        }
    }
}
</script>
