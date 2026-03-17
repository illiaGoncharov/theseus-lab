export default function CookiesPage() {
  return (
    <div className="min-h-screen bg-black text-white">
      <div className="max-w-4xl mx-auto px-6 py-32">
        <h1 className="font-['Syne'] text-5xl md:text-6xl font-bold mb-8">
          Политика использования cookies
        </h1>
        
        <div className="text-white/60 mb-6">
          Последнее обновление: {new Date().toLocaleDateString('ru-RU')}
        </div>

        <div className="space-y-12 text-white/80 leading-relaxed">
          <section>
            <h2 className="font-['Syne'] text-2xl font-bold text-white mb-4">
              1. Что такое cookies
            </h2>
            <p>
              Cookies — это небольшие текстовые файлы, которые сохраняются на вашем устройстве при посещении веб-сайтов. 
              Они помогают сайту запоминать информацию о вашем визите, что делает последующие посещения более удобными 
              и позволяет сайту быть более полезным для вас.
            </p>
          </section>

          <section>
            <h2 className="font-['Syne'] text-2xl font-bold text-white mb-4">
              2. Какие cookies мы используем
            </h2>
            <div className="space-y-4">
              <div>
                <h3 className="text-lg font-semibold text-white mb-2">Необходимые cookies</h3>
                <p>
                  Эти cookies необходимы для функционирования сайта и не могут быть отключены в наших системах. 
                  Обычно они устанавливаются только в ответ на ваши действия, такие как настройка параметров 
                  конфиденциальности, вход в систему или заполнение форм.
                </p>
              </div>

              <div>
                <h3 className="text-lg font-semibold text-white mb-2">Функциональные cookies</h3>
                <p>
                  Эти cookies позволяют сайту предоставлять расширенную функциональность и персонализацию. 
                  Они могут устанавливаться нами или сторонними поставщиками услуг, которые мы добавили на наши страницы.
                </p>
              </div>

              <div>
                <h3 className="text-lg font-semibold text-white mb-2">Аналитические cookies</h3>
                <p>
                  Эти cookies позволяют нам подсчитывать посещения и источники трафика, чтобы мы могли измерять 
                  и улучшать производительность нашего сайта. Они помогают нам узнать, какие страницы наиболее 
                  и наименее популярны, и увидеть, как посетители перемещаются по сайту.
                </p>
              </div>
            </div>
          </section>

          <section>
            <h2 className="font-['Syne'] text-2xl font-bold text-white mb-4">
              3. Управление cookies
            </h2>
            <p className="mb-4">
              Вы можете контролировать и/или удалять cookies по своему усмотрению. Вы можете удалить все cookies, 
              которые уже находятся на вашем компьютере, и настроить большинство браузеров так, чтобы они не 
              устанавливались.
            </p>
            <p>
              Однако в этом случае вам, возможно, придется вручную настраивать некоторые параметры при каждом 
              посещении сайта, и некоторые функции могут не работать.
            </p>
          </section>

          <section>
            <h2 className="font-['Syne'] text-2xl font-bold text-white mb-4">
              4. Сторонние cookies
            </h2>
            <p>
              В некоторых особых случаях мы также используем cookies, предоставляемые доверенными третьими сторонами. 
              Эти сторонние cookies используются для аналитики и улучшения пользовательского опыта на нашем сайте.
            </p>
          </section>

          <section>
            <h2 className="font-['Syne'] text-2xl font-bold text-white mb-4">
              5. Изменения в политике
            </h2>
            <p>
              Мы можем периодически обновлять эту политику использования cookies. Мы рекомендуем вам регулярно 
              проверять эту страницу, чтобы быть в курсе любых изменений.
            </p>
          </section>

          <section>
            <h2 className="font-['Syne'] text-2xl font-bold text-white mb-4">
              6. Контактная информация
            </h2>
            <p>
              Если у вас есть вопросы относительно нашей политики использования cookies, пожалуйста, свяжитесь с нами:
            </p>
            <div className="mt-4 space-y-2">
              <p>Email: info@theseuslab.com</p>
              <p>Telegram: @theseuslab</p>
            </div>
          </section>
        </div>
      </div>
    </div>
  );
}