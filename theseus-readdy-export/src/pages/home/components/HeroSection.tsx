import { useEffect, useRef } from 'react';
import { Link } from 'react-router-dom';

interface Dot {
  x: number;
  y: number;
  baseR: number;
  r: number;
}

const HeroSection = () => {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const sectionRef = useRef<HTMLElement>(null);
  const glowRef = useRef<HTMLDivElement>(null);
  const mouseRef = useRef({ x: -9999, y: -9999 });
  const dotsRef = useRef<Dot[]>([]);
  const rafRef = useRef<number>(0);

  useEffect(() => {
    const canvas = canvasRef.current;
    const section = sectionRef.current;
    const glow = glowRef.current;
    if (!canvas || !section || !glow) return;
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const SPACING = 40;
    const BASE_R = 1.5;
    const MAX_R = 8;
    const INFLUENCE = 150;

    const resize = () => {
      canvas.width = canvas.offsetWidth;
      canvas.height = canvas.offsetHeight;
      buildDots();
    };

    const buildDots = () => {
      const cols = Math.ceil(canvas.width / SPACING) + 1;
      const rows = Math.ceil(canvas.height / SPACING) + 1;
      const dots: Dot[] = [];
      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          dots.push({ x: c * SPACING, y: r * SPACING, baseR: BASE_R, r: BASE_R });
        }
      }
      dotsRef.current = dots;
    };

    const draw = () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      const mx = mouseRef.current.x;
      const my = mouseRef.current.y;

      for (const dot of dotsRef.current) {
        const dx = dot.x - mx;
        const dy = dot.y - my;
        const dist = Math.sqrt(dx * dx + dy * dy);
        const factor = Math.max(0, 1 - dist / INFLUENCE);
        dot.r = dot.baseR + (MAX_R - dot.baseR) * factor * factor;

        ctx.beginPath();
        ctx.arc(dot.x, dot.y, dot.r, 0, Math.PI * 2);
        const alpha = 0.12 + 0.38 * factor * factor;
        ctx.fillStyle = `rgba(255,255,255,${alpha})`;
        ctx.fill();
      }

      rafRef.current = requestAnimationFrame(draw);
    };

    resize();
    draw();

    const ro = new ResizeObserver(resize);
    ro.observe(canvas);

    const onMove = (e: MouseEvent) => {
      const canvasRect = canvas.getBoundingClientRect();
      mouseRef.current = { x: e.clientX - canvasRect.left, y: e.clientY - canvasRect.top };

      // Двигаем glow напрямую через DOM — без задержки
      glow.style.left = `${e.clientX - canvasRect.left}px`;
      glow.style.top = `${e.clientY - canvasRect.top}px`;
    };

    const onLeave = () => {
      mouseRef.current = { x: -9999, y: -9999 };
      const rect = section.getBoundingClientRect();
      glow.style.left = `${rect.width * 0.8}px`;
      glow.style.top = `${rect.height * 0.3}px`;
    };

    // Начальная позиция glow
    const initRect = section.getBoundingClientRect();
    glow.style.left = `${initRect.width * 0.8}px`;
    glow.style.top = `${initRect.height * 0.3}px`;

    section.addEventListener('mousemove', onMove);
    section.addEventListener('mouseleave', onLeave);

    return () => {
      cancelAnimationFrame(rafRef.current);
      ro.disconnect();
      section.removeEventListener('mousemove', onMove);
      section.removeEventListener('mouseleave', onLeave);
    };
  }, []);

  return (
    <section ref={sectionRef} className="relative min-h-screen flex items-center overflow-hidden bg-[#0C0C0C]">

      {/* Dot grid canvas */}
      <canvas
        ref={canvasRef}
        className="absolute inset-0 w-full h-full pointer-events-none"
        style={{ zIndex: 1 }}
      />

      {/* Cell grid lines */}
      <div
        className="absolute inset-0 pointer-events-none"
        style={{
          backgroundImage:
            'linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px)',
          backgroundSize: '80px 80px',
          zIndex: 2,
        }}
      />

      {/* Glow — позиция управляется напрямую через ref, без transition */}
      <div
        ref={glowRef}
        className="absolute pointer-events-none"
        style={{
          transform: 'translate(-50%, -50%)',
          width: '750px',
          height: '750px',
          background:
            'radial-gradient(circle, rgba(232,255,71,0.12) 0%, rgba(232,255,71,0.05) 40%, transparent 70%)',
          borderRadius: '50%',
          zIndex: 3,
        }}
      />

      {/* Content */}
      <div className="relative w-full max-w-[1400px] mx-auto px-6 lg:px-16 pt-40 pb-32 flex flex-col items-center text-center" style={{ zIndex: 10 }}>

        <h1 className="font-display font-bold text-[clamp(3rem,8vw,7rem)] leading-[0.95] tracking-tight text-white mb-10">
          Разработка<br />
          <span className="text-[#E8FF47]">AI решений</span>
        </h1>

        <p className="font-sans text-base text-white/45 max-w-lg leading-relaxed mb-12 font-light">
          Создаём интеллектуальные системы для анализа визуальных данных,
          мониторинга операций и автоматизации принятия решений.
        </p>

        <div className="flex items-center gap-4 flex-wrap justify-center">
          <Link
            to="/contact"
            className="inline-flex items-center gap-2 px-7 py-3 text-sm font-semibold bg-[#E8FF47] text-[#0C0C0C] hover:bg-white rounded-md transition-colors whitespace-nowrap cursor-pointer font-sans"
          >
            Оставить заявку
            <i className="ri-arrow-right-line text-base" />
          </Link>
          <Link
            to="/cases"
            className="inline-flex items-center gap-2 px-7 py-3 border border-white/20 text-white/70 hover:border-white/50 hover:text-white text-sm font-medium rounded-md transition-all whitespace-nowrap cursor-pointer font-sans"
          >
            Посмотреть кейсы
          </Link>
        </div>
      </div>

      {/* Bottom fade */}
      <div
        className="absolute bottom-0 left-0 right-0 h-32 pointer-events-none"
        style={{
          background: 'linear-gradient(to top, #0C0C0C, transparent)',
          zIndex: 5,
        }}
      />
    </section>
  );
};

export default HeroSection;
