<?php include 'Header.php' ?>
<main class="min-h-screen flex flex-col justify-center items-center px-4 py-10 bg-gray-50">
  <h1 class="text-4xl font-bold mb-3 text-center">ارتباط با ما</h1>
  <p class="text-gray-600 text-center text-sm max-w-lg mb-8">
    در صورت داشتن سوال یا بروز مشکل در سایت از طریق فرم زیر با ما در ارتباط باشید
  </p>

  <form class="bg-white shadow-md rounded-xl w-full max-w-2xl p-6">
    <label class="block mb-1 text-gray-700 font-semibold" for="name">نام</label>
    <input type="text" id="name" name="name" placeholder="نام خود را وارد کنید" class="w-full mb-4 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" required/>

    <label class="block mb-1 text-gray-700 font-semibold" for="email">ایمیل</label>
    <input type="email" id="email" name="email" placeholder="ایمیل خود را وارد کنید" class="w-full mb-4 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" required/>

    <label class="block mb-1 text-gray-700 font-semibold" for="message">متن پیام</label>
    <textarea id="message" name="message" rows="4" placeholder="متن مورد نطر را وارد کتید" class="w-full mb-6 px-3 py-2 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-300" required></textarea>

    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
      ارسال پیام
    </button>
  </form>
</main>
<?php include 'Footer.php' ?>