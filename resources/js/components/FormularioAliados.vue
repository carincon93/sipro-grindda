<template>
    <div class="aliados">
        <!-- <h5 class="text-center"></h5> -->
        <div class="row">
            <div class="col-md-3">
                <h5>Aliados</h5>
                <p class="campo-explicacion">
                    <small>Selecciona los aliados que conforman tu proyecto.</small>
                </p>
            </div>
            <div class="col-md-9">

                <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opcionAliadoInterno" v-model="checkedAliadoInterno" id="checkAliadoInterno">
                    <label class="form-check-label" for="checkAliadoInterno">
                        Aliado interno
                    </label>
                </div>
                <div v-if="checkedAliadoInterno">

                    <label for="cantidadAliadosInternos">Número de aliados internos</label>

                    <select id="cantidadAliadosInternos" class="custom-select select-small" name="" v-model.number="cantidadAliadosInternos">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div v-for="(cantidadAi, index) in cantidadAliadosInternos" class="aliados-items">

                        <h1>Aliado Interno Nro. {{ index + 1 }}</h1>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['nombreAliado_Interno.'+index]}">
                            <label :for="'nombreAliado_Interno'+index">Nombre del aliado Interno</label>
                            <input :id="'nombreAliado_Interno'+index" type="text" name="nombreAliado_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['nombreAliado_Interno.'+index]}" maxlength="191" required>
                            <span v-if="errors['nombreAliado_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['nombreAliado_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['nombreContactoAliado_Interno.'+index]}">
                            <label :for="'nombreContactoAliado_Interno'+index">Nombre del contacto</label>
                            <input :id="'nombreContactoAliado_Interno'+index" type="text" name="nombreContactoAliado_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['nombreContactoAliado_Interno.'+index]}" maxlength="191" required>
                            <span v-if="errors['nombreContactoAliado_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['nombreContactoAliado_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['celularContactoAliado_Interno.'+index]}">
                            <label :for="'celularContactoAliado_Interno'+index">Número de celular del contacto</label>
                            <input :id="'celularContactoAliado_Interno'+index" type="number" min="0" max="99999999999" name="celularContactoAliado_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['celularContactoAliado_Interno.'+index]}" required>
                            <span v-if="errors['celularContactoAliado_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['celularContactoAliado_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['emailContactoAliado_Interno.'+index]}">
                            <label :for="'emailContactoAliado_Interno'+index">Correo electrónico del contacto</label>
                            <input :id="'emailContactoAliado_Interno'+index" type="email" name="emailContactoAliado_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['emailContactoAliado_Interno.'+index]}" maxlength="191" required>
                            <span v-if="errors['emailContactoAliado_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['emailContactoAliado_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['compromisoContactoAliado_Interno.'+index]}">
                            <label :for="'compromisoContactoAliado_Interno'+index">Carta de compromiso</label>
                            <input :id="'compromisoContactoAliado_Interno'+index" type="file" name="compromisoContactoAliado_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['compromisoContactoAliado_Interno.'+index]}" required>
                            <span v-if="errors['compromisoContactoAliado_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['compromisoContactoAliado_Interno.'+index][0] }}</strong>
                            </span>
                        </div>

                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['recursosEspecie_Interno.'+index]}">
                            <label :for="'recursosEspecie_Interno'+index">Recursos en especie de entidad interna ($COP)</label>
                            <input :id="'recursosEspecie_Interno'+index" type="number" min="0" max="99999999999" name="recursosEspecie_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['recursosEspecie_Interno.'+index]}" required>
                            <span v-if="errors['recursosEspecie_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['recursosEspecie_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['recursosDinero_Interno.'+index]}">
                            <label :for="'recursosDinero_Interno'+index">Recursos en dinero de entidad interna ($COP)</label>
                            <input :id="'recursosDinero_Interno'+index" type="number" min="0" max="99999999999" name="recursosDinero_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['recursosDinero_Interno.'+index]}" required>
                            <span v-if="errors['recursosDinero_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['recursosDinero_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['ciudadesMunicipios_Interno.'+index]}">
                            <label :for="'ciudadesMunicipios_Interno'+index">Ciudades y/o municipios de influencia</label>
                            <input :id="'ciudadesMunicipios_Interno'+index" type="text" name="ciudadesMunicipios_Interno[]" class="form-control" v-bind:class="{'is-invalid' : errors['ciudadesMunicipios_Interno.'+index]}" required>
                            <span v-if="errors['ciudadesMunicipios_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['ciudadesMunicipios_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['descripcionAlianzaObjetivos_Interno.'+index]}">
                            <label :for="'descripcionAlianzaObjetivos_Interno'+index">Descripción de la alianza y objetivos</label>
                            <textarea :id="'descripcionAlianzaObjetivos_Interno'+index" name="descripcionAlianzaObjetivos_Interno[]" class="form-control" rows="8" cols="80" v-bind:class="{'is-invalid' : errors['descripcionAlianzaObjetivos_Interno.'+index]}" required></textarea>
                            <span v-if="errors['descripcionAlianzaObjetivos_Interno.'+index]" class="invalid-feedback">
                                <strong>{{ errors['descripcionAlianzaObjetivos_Interno.'+index][0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <img :src="asset+'images/separator.png'" alt="" class="separador img-fluid"> -->

                <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opcionAliadoExterno" v-model="checkedAliadoExterno" id="checkAliadoExterno">
                    <label class="form-check-label" for="checkAliadoExterno">
                        Aliado externo
                    </label>
                </div>
                <div v-if="checkedAliadoExterno"> -->

                    <label for="cantidadAliadosExternos">Número de aliados externos</label>

                    <select id="cantidadAliadosExternos" class="custom-select select-small" name="numeroAliados" v-model.number="cantidadAliadosExternos">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div v-for="(cantidadAext, index) in cantidadAliadosExternos" class="aliados-items">

                        <h1>Aliado Externo Nro. {{ index + 1 }}</h1>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['nombreAliado_Externo.'+index]}">
                            <label :for="'nombreAliado_Externo'+index">Nombre del aliado externo</label>
                            <input :id="'nombreAliado_Externo'+index" type="text" name="nombreAliado_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['nombreAliado_Externo.'+index]}" maxlength="191" required>
                            <span v-if="errors['nombreAliado_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['nombreAliado_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['nitAliado_Externo.'+index]}">
                            <label :for="'nitAliado_Externo'+index">NIT</label>
                            <input :id="'nitAliado_Externo'+index" type="text" name="nitAliado_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['nitAliado_Externo.'+index]}" maxlength="191" required>
                            <span v-if="errors['nitAliado_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['nitAliado_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['nombreContactoAliado_Externo.'+index]}">
                            <label :for="'nombreContactoAliado_Externo'+index">Nombre del contacto</label>
                            <input :id="'nombreContactoAliado_Externo'+index" type="text" name="nombreContactoAliado_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['nombreContactoAliado_Externo.'+index]}" maxlength="191" required>
                            <span v-if="errors['nombreContactoAliado_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['nombreContactoAliado_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['celularContactoAliado_Externo.'+index]}">
                            <label :for="'celularContactoAliado_Externo'+index">Número de celular del contacto</label>
                            <input :id="'celularContactoAliado_Externo'+index" type="number" min="0" max="99999999999" name="celularContactoAliado_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['celularContactoAliado_Externo.'+index]}" required>
                            <span v-if="errors['celularContactoAliado_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['celularContactoAliado_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['emailContactoAliado_Externo.'+index]}">
                            <label :for="'emailContactoAliado_Externo'+index">Correo electrónico del contacto</label>
                            <input :id="'emailContactoAliado_Externo'+index" type="email" name="emailContactoAliado_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['emailContactoAliado_Externo.'+index]}" maxlength="191" required>
                            <span v-if="errors['emailContactoAliado_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['emailContactoAliado_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['convenioContactoAliado_Externo.'+index]}">
                            <label :for="'convenioContactoAliado_Externo'+index">Convenio</label>
                            <p>
                                firma de visto bueno represante legal de la empresa y subdirector de centro
                            </p>
                            <input :id="'convenioContactoAliado_Externo'+index" type="file" name="convenioContactoAliado_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['convenioContactoAliado_Externo.'+index]}" required>
                            <span v-if="errors['convenioContactoAliado_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['convenioContactoAliado_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['recursosEspecie_Externo.'+index]}">
                            <label :for="'recursosEspecie_Externo'+index">Recursos en especie de entidad externa ($COP)</label>
                            <input :id="'recursosEspecie_Externo'+index" type="number" min="0" max="99999999999" name="recursosEspecie_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['recursosEspecie_Externo.'+index]}" required>
                            <span v-if="errors['recursosEspecie_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['recursosEspecie_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['recursosDinero_Externo.'+index]}">
                            <label :for="'recursosDinero_Externo'+index">Recursos en dinero de entidad externa ($COP)</label>
                            <input :id="'recursosDinero_Externo'+index" type="number" min="0" max="99999999999" name="recursosDinero_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['recursosDinero_Externo.'+index]}" required>
                            <span v-if="errors['recursosDinero_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['recursosDinero_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['ciudadesMunicipios_Externo.'+index]}">
                            <label :for="'ciudadesMunicipios_Externo'+index">Ciudades y/o municipios de influencia</label>
                            <input :id="'ciudadesMunicipios_Externo'+index" type="text" name="ciudadesMunicipios_Externo[]" class="form-control" v-bind:class="{'is-invalid' : errors['ciudadesMunicipios_Externo.'+index]}" required>
                            <span v-if="errors['ciudadesMunicipios_Externo.'+index]" class="invalid-feedback">
                                <strong>{{ errors['ciudadesMunicipios_Externo.'+index][0] }}</strong>
                            </span>
                        </div>
                        <!-- <div class="form-group form-group-custom required">
                            <label for="descripcionAlianzaObjetivos_Externo">Descripción de la alianza y objetivos</label>
                            <textarea id="descripcionAlianzaObjetivos_Externo" name="descripcionAlianzaObjetivos_Externo[]" class="form-control" rows="8" cols="80"></textarea>
                        </div> -->
                    </div>
                <!-- </div> -->

                <img :src="asset+'images/separator.png'" alt="" class="separador img-fluid">
            </div>
        </div>
    </div>

</template>

<script type="text/javascript">
export default {
    props: ['errors'],
    data: function () {
        return {
            asset: asset,

            cantidadAliadosInternos: [],
            cantidadAliadosExternos: [],

            checkedAliadoInterno: false,
            checkedAliadoExterno: false,
        }
    }
}
</script>
