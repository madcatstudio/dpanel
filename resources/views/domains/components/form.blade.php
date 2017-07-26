<div class="row">
    <div class="col-md-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label" for="name">Name *</label>

        <input id="name" type="text" placeholder="example.com"
               class="form-control"
               name="name" value="{{ old('name') }}"
               aria-describedby="helpBlockName"
               required autofocus>

        @if ($errors->has('name'))
            <span id="helpBlockName" class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="col-md-4 form-group {{ $errors->has('registration_date') ? ' has-error' : '' }}">
        <label class="control-label" for="registration_date">Registration date  *</label>

        <input id="registration_date" type="date"
               class="form-control"
               name="registration_date" value="{{ old('registration_date') }}"
               aria-describedby="helpBlockRegistrationDate"
               required>

        @if ($errors->has('registration_date'))
            <span id="helpBlockRegistrationDate"
                  class="help-block">{{ $errors->first('registration_date') }}</span>
        @endif
    </div>

    <div class="col-md-4 form-group {{ $errors->has('ip') ? ' has-error' : '' }}">
        <label class="control-label" for="ip">IP Address *</label>

        <input id="ip" type="text" placeholder="192.168.0.1"
               class="form-control"
               name="ip" value="{{ old('ip') }}"
               aria-describedby="helpBlockIp"
               required>

        @if ($errors->has('ip'))
            <span id="helpBlockIp" class="help-block">{{ $errors->first('ip') }}</span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        <label class="control-label" for="hosting_id">Hosting</label>

        <select id="hosting_id" name="hosting_id"
                class="form-control">
            <option value="">Select hosting</option>
            @foreach($hostings as $hosting)
                <option value="{{ $hosting->id }}">{{ $hosting->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 form-group">
        <label class="control-label" for="maintainer_id">Maintainer</label>

        <select id="maintainer_id" name="maintainer_id"
                class="form-control">
            <option value="">Select maintainer</option>
            @foreach($maintainers as $maintainer)
                <option value="{{ $maintainer->id }}">{{ $maintainer->name }}</option>
            @endforeach
        </select>
    </div>
</div>