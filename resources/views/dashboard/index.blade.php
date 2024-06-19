@extends('layouts.app')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <!-- style="background-color: white;" -->
    <div class="cardBox" style="text-align:center">
      <div class="card">
        @hasanyrole('teacher|admin')
        <div>
          <div class="numbers">{{ App\Models\Exam::count() ?? '0' }}</div>
          <div class="cardName">Ujian</div>
        </div>

        <div class="iconBx">
          <ion-icon name="eye-outline"></ion-icon>
        </div>
      </div>

      <div class="card">
        <div>
          <div class="numbers">{{ App\Models\Question::count() ?? '0' }}</div>
          <div class="cardName">Soal</div>
        </div>

        <div class="iconBx">
          <ion-icon name="cart-outline"></ion-icon>
        </div>
      </div>

      <div class="card">
        <div>
          <div class="numbers">{{ App\Models\Subject::count() ?? '0' }}</div>
          <div class="cardName">Jenis Soal</div>
        </div>

        <div class="iconBx">
          <ion-icon name="chatbubbles-outline"></ion-icon>
        </div>
      </div>

      <div class="card">
        <div>
          <div class="numbers">{{ App\Models\User::role('admin')->count() ?? '0' }}</div>
          <div class="cardName">User</div>
        </div>

        <div class="iconBx">
          <ion-icon name="cash-outline"></ion-icon>
        </div>
      </div>
      @endhasanyrole
    </div>
    @hasrole('student')
    <div class="card">
      <div>
        <div class="numbers">{{ App\Models\User::role('student')->count() ?? '0' }}</div>
        <div class="cardName">Student</div>
      </div>
      <div class="iconBx">
        <ion-icon name="cash-outline"></ion-icon>
      </div>
    </div>
    @endhasrole
</div>
@endsection