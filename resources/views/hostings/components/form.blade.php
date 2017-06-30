<div class="row">
    <div class="col-md-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label" for="name">Name *</label>

        <input id="name" type="text" placeholder="hosting name"
               class="form-control"
               name="name" value="{{ old('name') }}"
               aria-describedby="helpBlockName"
               required autofocus>

        @if ($errors->has('name'))
            <span id="helpBlockName" class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="col-md-3 form-group {{ $errors->has('website') ? ' has-error' : '' }}">
        <label class="control-label" for="website">Website *</label>

        <input id="website" type="text" placeholder="http://www.example.com"
               class="form-control"
               name="website" value="{{ old('website') }}"
               aria-describedby="helpBlockWebsite"
               required>

        @if ($errors->has('name'))
            <span id="helpBlockWebsite" class="help-block">{{ $errors->first('website') }}</span>
        @endif
    </div>

    <div class="col-md-3 form-group {{ $errors->has('username') ? ' has-error' : '' }}">
        <label class="control-label" for="username">Username *</label>

        <input id="username" type="text" placeholder="Username"
               class="form-control"
               name="username" value="{{ old('username') }}"
               aria-describedby="helpBlockUsername"
               required>

        @if ($errors->has('username'))
            <span id="helpBlockUsername" class="help-block">{{ $errors->first('username') }}</span>
        @endif
    </div>

    <div class="col-md-3 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label" for="password">Password *</label>

        <input id="password" type="text" placeholder="Password"
               class="form-control"
               name="password" value="{{ old('password') }}"
               aria-describedby="helpBlockPassword"
               required>

        @if ($errors->has('password'))
            <span id="helpBlockPassword" class="help-block">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12 form-group {{ $errors->has('details') ? ' has-error' : '' }}">
        <label class="control-label" for="details">Details</label>

        <textarea id="details" name="details"
                  class="form-control" rows="5"
                  placeholder="Enter some details...">{{ old('details') }}</textarea>

        @if ($errors->has('details'))
            <span id="helpBlockDetails" class="help-block">{{ $errors->first('details') }}</span>
        @endif
    </div>
</div>