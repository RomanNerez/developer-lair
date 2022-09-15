<div class="custom-navbar" id="settings-element">
    <div class="pt-1">
        <div id="info-data-element" style="display: none">
            <div class="row mx-0 mt-1">
                <div class="col">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="width">width</label>
                            <input type="number" name="width" id="width" class="form-control" data-type="width">
                        </div>
                        <div class="form-group col-6">
                            <label for="height" >height</label>
                            <input type="number" name="height" id="height" class="form-control" data-type="height">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mt-1">
                <div class="col">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="x">x</label>
                            <input type="number" name="x" id="x" class="form-control" >
                        </div>
                        <div class="form-group col-6">
                            <label for="y">y</label>
                            <input type="number" name="x" id="y" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mt-1">
                <div class="col">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="angle">angle</label>
                            <input type="number" name="angle" id="angle" class="form-control" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mt-1">
                <div class="col">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="background">background</label>
                            <input type="text" name="background" id="background" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="fill">fill</label>
                            <input type="text" name="fill" id="fill" class="form-control" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mt-1" data-type="text">
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="line-height">line height</label>
                            <input type="number" name="line-height" id="line-height" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="font-size">font size</label>
                            <input type="number" name="font-size" id="font-size" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-row">
                        <div class="form-group" style="width: 100%">
                            <label for="text-align">text align</label>
                            <select id="text-align" name="form-control" class="form-control" style="width: 100%">
                                <option value="left" selected>Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-row">
                        <div class="form-group" style="width: 100%">
                            <label for="font-family">font family</label>
                            <select id="font-family" name="font-family" class="form-control" style="width: 100%">
                                @foreach($fonts as $font)
                                    @foreach($font['files'] as $name => $file)
                                        <option value="{{ $name }}" style="font-family: {{ $name }};">{{ $name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>