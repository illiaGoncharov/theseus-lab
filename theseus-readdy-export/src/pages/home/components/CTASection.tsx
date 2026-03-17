import { useRef, useEffect, useState } from 'react';

interface Props { theme?: 'dark' | 'light'; }

const CTASection = ({ theme = 'dark' }: Props) => {
  const isDark = theme === 'dark';
  const sectionRef = useRef<HTMLDivElement>(null);
  const [submitted, setSubmitted] = useState(false);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('opacity-100', 'translate-y-0');
            entry.target.classList.remove('opacity-0', 'translate-y-8');
          }
        });
      },
      { threshold: 0.1 }
    );
    const items = sectionRef.current?.querySelectorAll('.reveal-item');
    items?.forEach((item) => observer.observe(item));
    return () => observer.disconnect();
  }, []);

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setLoading(true);
    const form = e.currentTarget;
    const data = new URLSearchParams();
    data.append('name', (form.elements.namedItem('name') as HTMLInputElement).value);
    data.append('phone', (form.elements.namedItem('phone') as HTMLInputElement).value);
    try {
      await fetch('https://readdy.ai/api/form/d6njcs2qoe30lj0v8po0', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: data.toString(),
      });
      setSubmitted(true);
    } finally {
      setLoading(false);
    }
  };

  return (
    <section ref={sectionRef} className={`py-32 relative overflow-hidden ${isDark ? 'bg-dark-surface' : 'bg-light-surface'}`}>
      {/* Grid */}
      <div
        className="absolute inset-0 pointer-events-none"
        style={{
          backgroundImage: isDark
            ? 'linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px)'
            : 'linear-gradient(rgba(0,0,0,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.04) 1px, transparent 1px)',
          backgroundSize: '80px 80px',
        }}
      />
      {/* Glow */}
      <div
        className="absolute pointer-events-none"
        style={{
          top: '50%', left: '50%',
          transform: 'translate(-50%, -50%)',
          width: '700px', height: '400px',
          background: isDark
            ? 'radial-gradient(ellipse, rgba(232,255,71,0.05) 0%, transparent 70%)'
            : 'radial-gradient(ellipse, rgba(184,204,0,0.10) 0%, transparent 70%)',
        }}
      />

      <div className="relative z-10 max-w-[1400px] mx-auto px-6 lg:px-16">
        <div className={`reveal-item opacity-0 translate-y-8 transition-all duration-700 border rounded-3xl p-12 lg:p-20 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-12 ${
          isDark ? 'border-white/8' : 'border-gray-200'
        }`}>
          {/* Left */}
          <div className="max-w-xl">
            <div className="flex items-center gap-3 mb-6">
              <div className={`w-6 h-px ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
              <span className={`text-xs font-medium tracking-[0.2em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>
                Начать проект
              </span>
            </div>
            <h2 className={`font-display text-5xl lg:text-6xl font-bold leading-tight mb-6 ${isDark ? 'text-white' : 'text-gray-900'}`}>
              Готовы обсудить<br />
              <span className={isDark ? 'text-white/30' : 'text-gray-400'}>вашу задачу?</span>
            </h2>
            <p className={`text-base font-sans leading-relaxed max-w-lg ${isDark ? 'text-white/40' : 'text-gray-400'}`}>
              Расскажите о вашей задаче — мы проведём бесплатную консультацию и предложим оптимальное AI-решение под ваш бизнес.
            </p>
          </div>

          {/* Right — form */}
          <div className="w-full lg:w-[480px] shrink-0">
            {submitted ? (
              <div className={`flex flex-col items-center justify-center gap-4 py-10 rounded-2xl border ${isDark ? 'border-white/8 text-white' : 'border-gray-200 text-gray-900'}`}>
                <i className={`ri-checkbox-circle-line text-4xl w-10 h-10 flex items-center justify-center ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`} />
                <p className="text-base font-sans font-medium">Заявка отправлена!</p>
                <p className={`text-sm font-sans ${isDark ? 'text-white/40' : 'text-gray-400'}`}>Мы свяжемся с вами в ближайшее время.</p>
              </div>
            ) : (
              <form
                data-readdy-form
                id="cta-lead-form"
                onSubmit={handleSubmit}
                className="flex flex-col gap-4"
              >
                <input
                  type="text"
                  name="name"
                  required
                  placeholder="Ваше имя"
                  className={`w-full px-5 py-4 rounded-xl text-sm font-sans outline-none transition-colors ${
                    isDark
                      ? 'bg-white/5 border border-white/10 text-white placeholder-white/30 focus:border-white/30'
                      : 'bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-gray-400'
                  }`}
                />
                <input
                  type="tel"
                  name="phone"
                  required
                  placeholder="Телефон"
                  className={`w-full px-5 py-4 rounded-xl text-sm font-sans outline-none transition-colors ${
                    isDark
                      ? 'bg-white/5 border border-white/10 text-white placeholder-white/30 focus:border-white/30'
                      : 'bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-gray-400'
                  }`}
                />
                <button
                  type="submit"
                  disabled={loading}
                  className={`w-full inline-flex items-center justify-center gap-2 px-8 py-4 text-sm font-semibold rounded-xl transition-colors whitespace-nowrap cursor-pointer font-sans disabled:opacity-60 ${
                    isDark ? 'bg-accent-lime text-dark-bg hover:bg-white' : 'bg-accent-lime-dark text-white hover:bg-gray-900'
                  }`}
                >
                  {loading ? 'Отправка...' : 'Оставить заявку'}
                  {!loading && <i className="ri-arrow-right-line text-base w-4 h-4 flex items-center justify-center" />}
                </button>
                <p className={`text-xs font-sans text-center ${isDark ? 'text-white/20' : 'text-gray-400'}`}>
                  Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности
                </p>
              </form>
            )}
          </div>
        </div>
      </div>
    </section>
  );
};

export default CTASection;
