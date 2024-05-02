@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Ujian</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Ujian</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('exams.update', $exam->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>NAMA</label>
                            <input type="text" name="name" value="{{ old('name', $exam->name) }}" class="form-control" >
                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>WAKTU (MENIT)</label>
                            <input type="number" name="time" value="{{ old('time', $exam->time) }}" class="form-control" >

                            @error('time')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>JUMLAH SOAL</label>
                            <input type="number" name="total_question" value="{{ old('total_question', $exam->total_question) }}" class="form-control" >

                            @error('total_question')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>MULAI</label>
                            <input type="datetime-local" name="start" value="<?php echo date('Y-m-d\TH:i:s', strtotime($exam->start)); ?>" class="form-control @error('start') is-invalid @enderror">

                            @error('start')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>BERAKHIR</label>
                            <input type="datetime-local" name="end" value="<?php echo date('Y-m-d\TH:i:s', strtotime($exam->end)); ?>" class="form-control @error('end') is-invalid @enderror">

                            @error('end')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @livewire('question-checklist', ['selectedExam' => $exam->id])


                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop