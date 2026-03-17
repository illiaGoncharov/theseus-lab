import { useState } from 'react';

const industries = ['Все', 'Производство', 'Логистика', 'Ритейл', 'Строительство', 'Офисы'];

const casesData = [
  {
    id: 1,
    title: 'Система контроля безопасности на складе',
    industry: 'Логистика',
    challenge: 'Отсутствие контроля за соблюдением правил безопасности на складе площадью 15 000 м²',
    solution: 'Внедрение системы компьютерного зрения для детекции нарушений: отсутствие касок, нахождение в опасных зонах, превышение скорости погрузчиков',
    result: 'Снижение инцидентов на 78% за 6 месяцев',
    image: 'https://readdy.ai/api/search-image?query=modern%20warehouse%20with%20safety%20monitoring%20system%2C%20overhead%20view%20of%20industrial%20storage%20facility%20with%20marked%20safety%20zones%20and%20equipment%2C%20clean%20professional%20lighting%2C%20technology%20overlay%20with%20detection%20boxes%20highlighting%20workers%20and%20forklifts%2C%20blue%20and%20yellow%20safety%20markings%2C%20organized%20logistics%20environment%2C%20high-tech%20surveillance%20aesthetic&width=800&height=600&seq=case1&orientation=landscape',
  },
  {
    id: 2,
    title: 'Анализ производительности сборочной линии',
    industry: 'Производство',
    challenge: 'Невозможность объективно оценить эффективность работы операторов на производственной линии',
    solution: 'AI-система анализа движений и времени выполнения операций с выявлением узких мест и оптимизацией процессов',
    result: 'Рост производительности на 23%, сокращение простоев на 31%',
    image: 'https://readdy.ai/api/search-image?query=modern%20manufacturing%20assembly%20line%20with%20robotic%20arms%20and%20workers%2C%20clean%20industrial%20production%20facility%20with%20organized%20workstations%2C%20bright%20overhead%20lighting%2C%20technology%20interface%20showing%20performance%20metrics%20and%20motion%20tracking%20overlays%2C%20efficient%20workflow%20visualization%2C%20high-tech%20factory%20environment%20with%20quality%20control%20systems&width=800&height=600&seq=case2&orientation=landscape',
  },
  {
    id: 3,
    title: 'Распознавание дефектов металлопроката',
    industry: 'Производство',
    challenge: 'Ручной контроль качества занимал 40% времени смены, высокий процент пропущенных дефектов',
    solution: 'Система компьютерного зрения для автоматической детекции царапин, вмятин, коррозии и других дефектов на поверхности металла',
    result: 'Точность обнаружения дефектов 99.2%, сокращение времени контроля в 8 раз',
    image: 'https://readdy.ai/api/search-image?query=close-up%20of%20metal%20sheet%20surface%20inspection%20with%20AI%20detection%20system%2C%20industrial%20quality%20control%20setup%20with%20bright%20uniform%20lighting%2C%20metal%20surface%20with%20subtle%20defects%20highlighted%20by%20digital%20overlay%20boxes%20and%20markers%2C%20precision%20measurement%20interface%2C%20clean%20technical%20photography%20style%2C%20automated%20inspection%20technology%20aesthetic&width=800&height=600&seq=case3&orientation=landscape',
  },
  {
    id: 4,
    title: 'Мониторинг заполненности торговых полок',
    industry: 'Ритейл',
    challenge: 'Отсутствие оперативной информации о наличии товара на полках, потери продаж из-за пустых мест',
    solution: 'Система распознавания товаров и контроля заполненности полок в режиме реального времени с уведомлениями персонала',
    result: 'Увеличение продаж на 17%, сокращение out-of-stock ситуаций на 64%',
    image: 'https://readdy.ai/api/search-image?query=modern%20retail%20store%20shelves%20with%20products%2C%20clean%20supermarket%20aisle%20with%20organized%20merchandise%20display%2C%20bright%20commercial%20lighting%2C%20AI%20monitoring%20overlay%20showing%20product%20recognition%20boxes%20and%20stock%20level%20indicators%2C%20digital%20interface%20highlighting%20empty%20spaces%20and%20inventory%20status%2C%20professional%20retail%20technology%20visualization&width=800&height=600&seq=case4&orientation=landscape',
  },
  {
    id: 5,
    title: 'Контроль использования СИЗ на стройплощадке',
    industry: 'Строительство',
    challenge: 'Невозможность постоянного контроля за использованием средств индивидуальной защиты на объекте с 200+ рабочими',
    solution: 'AI-система детекции наличия касок, жилетов, защитных очков и обуви у работников в различных зонах стройплощадки',
    result: 'Соблюдение требований безопасности выросло с 67% до 96%',
    image: 'https://readdy.ai/api/search-image?query=construction%20site%20with%20workers%20wearing%20safety%20equipment%2C%20active%20building%20site%20with%20scaffolding%20and%20construction%20materials%2C%20natural%20daylight%2C%20AI%20safety%20monitoring%20system%20overlay%20with%20detection%20boxes%20highlighting%20hard%20hats%2C%20safety%20vests%20and%20protective%20gear%20on%20workers%2C%20organized%20construction%20environment%2C%20professional%20safety%20technology%20visualization&width=800&height=600&seq=case5&orientation=landscape',
  },
  {
    id: 6,
    title: 'Анализ посещаемости офисных зон',
    industry: 'Офисы',
    challenge: 'Неэффективное использование офисного пространства, отсутствие данных о загруженности переговорных и зон отдыха',
    solution: 'Система подсчета посетителей и анализа использования различных зон офиса с построением heat-map и рекомендациями по оптимизации',
    result: 'Оптимизация пространства позволила сократить аренду на 22%',
    image: 'https://readdy.ai/api/search-image?query=modern%20open%20office%20space%20with%20meeting%20rooms%20and%20collaborative%20areas%2C%20contemporary%20workplace%20with%20glass%20partitions%20and%20comfortable%20furniture%2C%20natural%20and%20ambient%20lighting%2C%20technology%20overlay%20showing%20occupancy%20heat%20maps%20and%20people%20counting%20analytics%2C%20clean%20professional%20office%20environment%2C%20workspace%20optimization%20visualization%20with%20data%20dashboards&width=800&height=600&seq=case6&orientation=landscape',
  },
  {
    id: 7,
    title: 'Распознавание номеров вагонов на сортировочной станции',
    industry: 'Логистика',
    challenge: 'Ручная фиксация номеров вагонов занимала 4 часа на состав, высокий процент ошибок',
    solution: 'Система автоматического распознавания номеров вагонов с интеграцией в учетную систему железнодорожной станции',
    result: 'Время обработки состава сократилось до 12 минут, точность 99.7%',
    image: 'https://readdy.ai/api/search-image?query=railway%20sorting%20yard%20with%20freight%20train%20cars%2C%20industrial%20rail%20station%20with%20multiple%20tracks%20and%20cargo%20wagons%2C%20overcast%20daylight%2C%20AI%20recognition%20system%20overlay%20highlighting%20wagon%20numbers%20and%20identification%20codes%2C%20automated%20logistics%20technology%20interface%2C%20professional%20railway%20infrastructure%20with%20digital%20tracking%20visualization&width=800&height=600&seq=case7&orientation=landscape',
  },
  {
    id: 8,
    title: 'Детекция аномалий в работе конвейера',
    industry: 'Производство',
    challenge: 'Внеплановые остановки конвейера из-за застреваний и поломок приводили к потерям до 8 часов в неделю',
    solution: 'AI-система мониторинга конвейера с предиктивной аналитикой и детекцией аномалий в режиме реального времени',
    result: 'Сокращение простоев на 73%, переход к предиктивному обслуживанию',
    image: 'https://readdy.ai/api/search-image?query=industrial%20conveyor%20belt%20system%20in%20modern%20factory%2C%20automated%20production%20line%20with%20packages%20and%20products%20moving%2C%20bright%20industrial%20lighting%2C%20AI%20monitoring%20overlay%20showing%20anomaly%20detection%20zones%20and%20predictive%20maintenance%20indicators%2C%20clean%20manufacturing%20environment%2C%20technology%20interface%20with%20real-time%20status%20visualization%20and%20alert%20systems&width=800&height=600&seq=case8&orientation=landscape',
  },
];

export default function CasesPage() {
  const [selectedIndustry, setSelectedIndustry] = useState('Все');

  const filteredCases = selectedIndustry === 'Все' 
    ? casesData 
    : casesData.filter(c => c.industry === selectedIndustry);

  return (
    <div className="min-h-screen bg-black text-white">
      {/* Hero */}
      <section className="pt-32 pb-20 px-6">
        <div className="max-w-7xl mx-auto">
          <h1 className="font-['Syne'] text-6xl md:text-7xl font-bold mb-6">
            Кейсы
          </h1>
          <p className="text-xl text-white/60 max-w-2xl">
            Реальные проекты внедрения AI-систем в различных отраслях
          </p>
        </div>
      </section>

      {/* Filter */}
      <section className="pb-12 px-6">
        <div className="max-w-7xl mx-auto">
          <div className="flex flex-wrap gap-3">
            {industries.map((industry) => (
              <button
                key={industry}
                onClick={() => setSelectedIndustry(industry)}
                className={`px-6 py-2.5 rounded-full border transition-all whitespace-nowrap cursor-pointer ${
                  selectedIndustry === industry
                    ? 'bg-lime-400 text-black border-lime-400'
                    : 'bg-transparent text-white/60 border-white/20 hover:border-white/40 hover:text-white/80'
                }`}
              >
                {industry}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Cases Grid */}
      <section className="pb-32 px-6">
        <div className="max-w-7xl mx-auto">
          <div className="grid md:grid-cols-2 gap-8">
            {filteredCases.map((caseItem) => (
              <div
                key={caseItem.id}
                className="group bg-white/5 border border-white/10 overflow-hidden hover:border-lime-400/50 transition-all duration-300"
              >
                <div className="aspect-[4/3] overflow-hidden">
                  <img
                    src={caseItem.image}
                    alt={caseItem.title}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                </div>
                <div className="p-8">
                  <div className="text-sm text-lime-400 mb-3">{caseItem.industry}</div>
                  <h3 className="font-['Syne'] text-2xl font-bold mb-4">
                    {caseItem.title}
                  </h3>
                  
                  <div className="space-y-4 text-sm">
                    <div>
                      <div className="text-white/40 mb-1">Задача</div>
                      <div className="text-white/80">{caseItem.challenge}</div>
                    </div>
                    
                    <div>
                      <div className="text-white/40 mb-1">Решение</div>
                      <div className="text-white/80">{caseItem.solution}</div>
                    </div>
                    
                    <div>
                      <div className="text-white/40 mb-1">Результат</div>
                      <div className="text-lime-400 font-medium">{caseItem.result}</div>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}