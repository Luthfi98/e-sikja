<div class="container">
    <div class="row justify-content-center">
        <div class="mb-4">
            <input type="hidden" name="village_head" value="Budi Triyono S.Sos.MM">
            <input type="hidden" name="village_head_position" value="Lurah Jantiharjo">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name', $resident->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                        id="nik" name="nik" value="{{ old('nik', $resident->nik) }}" required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select @error('gender') is-invalid @enderror" 
                        id="gender" name="gender" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender', $resident->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $resident->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pob" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('pob') is-invalid @enderror" 
                        id="pob" name="pob" value="{{ old('pob', $resident->pob) }}" required>
                    @error('pob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" 
                        id="dob" name="dob" value="{{ old('dob', date('Y-m-d', strtotime($resident->dob)) ?: $resident->dob) }}" required>
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                        id="address" name="address" rows="3" required>{{ old('address', $resident->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="business_name" class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('business_name') is-invalid @enderror" 
                        id="business_name" name="business_name" value="{{ old('business_name') }}" required>
                    @error('business_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="business_start_date" class="form-label">Mulai Usaha Sejak <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('business_start_date') is-invalid @enderror" 
                        id="business_start_date" name="business_start_date" value="{{ old('business_start_date') }}" required>
                    @error('business_start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="business_address" class="form-label">Alamat Usaha <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('business_address') is-invalid @enderror" 
                        id="business_address" name="business_address" rows="3" required>{{ old('business_address') }}</textarea>
                    @error('business_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h5 class="mb-4"><b>Dokumen yang Diperlukan</b></h5>
            @if($requestType->required_documents)
                @foreach(json_decode($requestType->required_documents) as $index => $document)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="document_{{ $index }}" class="form-label">{{ $document }} @if(!str_contains($document, '(Optional)')) <span class="text-danger">*</span> @endif</label>
                        <input type="file" class="form-control @error('documents.'.$index) is-invalid @enderror" 
                            id="document_{{ $index }}" name="documents[]" {{ str_contains($document, '(Optional)') ? '' : 'required' }}>
                        @error('documents.'.$index)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

